<?php
/**
 * @package    hubzero-cms
 * @copyright  Copyright 2005-2019 HUBzero Foundation, LLC.
 * @license    http://opensource.org/licenses/MIT MIT
 */

namespace Components\Collections\Models\Orm;

use Components\Tags\Models\Cloud;

require_once \Component::path('com_tags') . DS . 'models' . DS . 'cloud.php';

/**
 * Collections Tagging class
 */
class Tags extends Cloud
{
	/**
	 * Object type, used for linking objects (such as resources) to tags
	 *
	 * @var  string
	 */
	protected $_scope = 'bulletinboard';
}
