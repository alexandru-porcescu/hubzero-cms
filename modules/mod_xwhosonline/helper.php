<?php
/**
 * @package		HUBzero CMS
 * @author		Shawn Rice <zooley@purdue.edu>
 * @copyright	Copyright 2005-2009 by Purdue Research Foundation, West Lafayette, IN 47906
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 *
 * Copyright 2005-2009 by Purdue Research Foundation, West Lafayette, IN 47906.
 * All rights reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License,
 * version 2 as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class modXWhosonline 
{
	private $attributes = array();

	//-----------

	public function __construct( $params ) 
	{
		$this->params = $params;
	}

	//-----------

	public function __set($property, $value)
	{
		$this->attributes[$property] = $value;
	}
	
	//-----------
	
	public function __get($property)
	{
		if (isset($this->attributes[$property])) {
			return $this->attributes[$property];
		}
	}

	//-----------

	public function display() 
	{
		$database =& JFactory::getDBO();
		
		$params  =& $this->params;
		$this->online = $params->get( 'online' );
		$this->users  = $params->get( 'users' );
		$moduleclass_sfx = $params->get( 'moduleclass_sfx' );

		$juser =& JFactory::getUser();
		$this->admin = $juser->authorize('mod_xwhosonline', 'manage');

		if ($this->online) {
			$query1 = "SELECT COUNT(DISTINCT ip) AS guest_online FROM #__session WHERE guest=1 AND (usertype is NULL OR usertype='')";
			$database->setQuery($query1);
			$this->guest_array = $database->loadResult();

			$query2 = "SELECT COUNT(DISTINCT username) AS user_online FROM #__session WHERE guest=0 AND usertype <> 'administrator' AND usertype <> 'superadministrator'";
			$database->setQuery($query2);
			$this->user_array = $database->loadResult();
		} else {
			$this->guest_array = null;
			$this->user_array = null;
		}

		if ($this->users) {
			$query = "SELECT DISTINCT a.username"
					."\n FROM #__session AS a"
					."\n WHERE (a.guest=0)";
			$database->setQuery($query);
			$this->rows = $database->loadObjectList();
		} else {
			$this->rows = null;
		}
	}
}