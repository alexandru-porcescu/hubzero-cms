<?php
/**
 * @package    hubzero-cms
 * @copyright  Copyright 2005-2019 HUBzero Foundation, LLC.
 * @license    http://opensource.org/licenses/MIT MIT
 */

// no direct access
defined('_HZEXEC_') or die;

/**
 * Page Cache Plugin
 */
class plgSystemCache extends \Hubzero\Plugin\Plugin
{
	/**
	 * Constructor
	 *
	 * @var  object
	 */
	private $id = null;

	/**
	 * Converting the site URL to fit to the HTTP request
	 *
	 * @return  void
	 */
	public function getId()
	{
		if (!$this->id)
		{
			$this->id = 'page.' . md5($_SERVER['REQUEST_URI']);
		}
		return $this->id;
	}

	/**
	 * Converting the site URL to fit to the HTTP request
	 *
	 * @return  void
	 */
	public function onAfterInitialise()
	{
		if (App::isAdmin() || Config::get('debug'))
		{
			return;
		}

		if (Notify::any() || !App::has('cache'))
		{
			return;
		}

		if (User::isGuest() && Request::method() == 'GET' && $this->params->get('pagecache', false))
		{
			$id = $this->getId();

			if ($data = App::get('cache')->get($id))
			{
				App::get('response')->setContent($data);

				App::get('response')->compress(App::get('config')->get('gzip', false));

				if ($this->params->get('browsercache', false))
				{
					App::get('response')->headers->set('HTTP/1.x 304 Not Modified', true);
				}

				App::get('response')->headers->set('ETag', $id);

				App::get('response')->send();

				if ($profiler = App::get('profiler'))
				{
					$profiler->mark('afterCache');
					echo implode('', $profiler->marks());
				}

				App::close();
			}
		}
	}

	/**
	 * Save cached data
	 *
	 * @return  void
	 */
	public function onAfterRender()
	{
		if (App::isAdmin() || Config::get('debug'))
		{
			return;
		}

		if (Notify::any() || !App::has('cache'))
		{
			return;
		}

		if (User::isGuest() && $this->params->get('pagecache', false))
		{
			$path = trim(str_replace(Request::base(), '', Request::current()));
			$path = trim($path, '/');

			if ($this->isExempt($path) || $this->isExempt(Request::current()))
			{
				return;
			}

			// We need to check again here, because auto-login plugins
			// have not been fired before the first aid check
			App::get('cache')->put(
				$this->getId(),
				App::get('response')->getContent(),
				App::get('config')->get('lifetime', 45)
			);
		}
	}

	/**
	 * Check if the current URL is exempt from caching
	 *
	 * @param   string   $path
	 * @return  boolean  True if the current page is a rule
	 */
	private function isExempt($path)
	{
		$defs = str_replace("\r", '', $this->params->def('cacheexempt', '/about/contact'));
		$defs = explode("\n", $defs);

		foreach ($defs as $def)
		{
			$result = trim($def);
			$result = trim($result, '/');

			if ($result == $path)
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * Clean out cached CSS files
	 *
	 * @param   string   $group
	 * @param   integer  $client_id
	 * @return  void
	 */
	public function onCleanCache($group = null, $client_id = 0)
	{
		$dir = PATH_APP . '/cache';

		if (!is_dir($dir))
		{
			return;
		}

		$paths = array(
			$dir . '/site/site.css',
			$dir . '/site/site.less.cache'
		);

		foreach ($paths as $path)
		{
			if (file_exists($path))
			{
				Filesystem::delete($path);
			}
		}
	}
}
