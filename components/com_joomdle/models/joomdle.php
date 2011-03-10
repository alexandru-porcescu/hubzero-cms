<?php
/**
 * Joomla! 1.5 component Joomdle
 *
 * @version $Id: joomdle.php 2009-04-17 03:54:05 svn $
 * @author Antonio Durán Terrés
 * @package Joomla
 * @subpackage Joomdle
 * @license GNU/GPL
 *
 * Shows information about Moodle courses
 *
 * This component file was created using the Joomla Component Creator by Not Web Design
 * http://www.notwebdesign.com/joomla_component_creator/
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

/**
 * Joomdle Component Joomdle Model
 *
 * @author      notwebdesign
 * @package		Joomla
 * @subpackage	Joomdle
 * @since 1.5
 */
class JoomdleModelJoomdle extends JModel {
    /**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
    }
}
?>
