<?php
/**
 * HUBzero CMS
 *
 * Copyright 2005-2011 Purdue University. All rights reserved.
 *
 * This file is part of: The HUBzero(R) Platform for Scientific Collaboration
 *
 * The HUBzero(R) Platform for Scientific Collaboration (HUBzero) is free
 * software: you can redistribute it and/or modify it under the terms of
 * the GNU Lesser General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any
 * later version.
 *
 * HUBzero is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * HUBzero is a registered trademark of Purdue University.
 *
 * @package   hubzero-cms
 * @author    Shawn Rice <zooley@purdue.edu>
 * @copyright Copyright 2005-2011 Purdue University. All rights reserved.
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPLv3
 */

// Check to ensure this file is included in Joomla!
defined('_HZEXEC_') or die('Restricted access');
?>
<div<?php echo ($this->cssId) ? ' id="' . $this->cssId . '"' : ''; echo ($this->cssClass) ? ' class="' . $this->cssClass . '"' : ''; ?>>
	<p class="newtoolsheader">Popular Questions</p>
	<ul class="newtools clearfix">
<?php if (count($this->rows) > 0) { ?>
	<?php
	foreach ($this->rows as $row)
	{
		$name = Lang::txt('MOD_POPULARQUESTIONS_ANONYMOUS');
		if (!$row->get('anonymous'))
		{
			$name = $row->creator('name');
		}
		?>
		<li class="featuredtoolitem">
		<?php if ($this->style == 'compact') { ?>
			<a href="<?php echo Route::url($row->link()); ?>"><?php echo $this->escape($row->subject('clean')); ?></a>
		<?php } else { ?>
			<a href="<?php echo Route::url($row->link()); ?>"><?php echo $this->escape($row->subject('clean')); ?></a>
			<p class="small">
				<?php echo Lang::txt('MOD_POPULARQUESTIONS_ASKED_BY', $this->escape($name)); ?> @
				<span class="entry-time"><?php echo $row->created('time'); ?></span> on
				<span class="entry-date"><?php echo $row->created('date'); ?></span>
				<span class="entry-details-divider">&bull;</span>
				<span class="entry-comments">
					<a href="<?php echo Route::url($row->link() . '#answers'); ?>" title="<?php echo Lang::txt('MOD_RECENTQUESTIONS_RESPONSES', $row->get('rcount', 0)); ?>">
						<?php echo $row->get('rcount', 0); ?>
					</a>
				</span>
			</p>
			<p class="entry-tags"><?php echo Lang::txt('MOD_POPULARQUESTIONS_TAGS'); ?>:</p>
			<?php
			echo $row->tags('cloud');
			?>
		<?php } ?>
		</li>
		<?php
	}
	?>
<?php } else { ?>
	<li class="featuredtoolitem"><?php echo Lang::txt('MOD_POPULARQUESTIONS_NO_RESULTS'); ?></li>
<?php } ?>
  </ul>
</div>