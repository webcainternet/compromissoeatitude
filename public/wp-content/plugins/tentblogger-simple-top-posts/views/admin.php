<![CDATA[ TentBlogger Simple Top Posts 2.0 ]]>
<div class="tentblogger-top-posts-widget-wrapper">
	<fieldset>
		<legend>
			<?php _e('Widget Options', 'tentblogger-top-posts'); ?>
		</legend>
		
		<!-- title -->
		<label for="<?php echo $this->get_field_id('widget_title'); ?>" class="block">
			<?php _e('Title:', 'tentblogger-top-posts'); ?>
		</label>
		<input type="text" name="<?php echo $this->get_field_name('widget_title'); ?>" id="<?php echo $this->get_field_id('widget_title'); ?>" value="<?php echo $instance['widget_title']; ?>" class="" />
		<!-- /title -->

		<!-- date range -->
		<label for="<?php echo $this->get_field_id('date_range'); ?>" class="block">
			<?php _e('Date Range:', 'tentblogger-top-posts'); ?>
		</label>
		<select id="<?php echo $this->get_field_id('date_range'); ?>" name="<?php echo $this->get_field_name('date_range'); ?>">
			<option value="weekly" <?php if ( 'weekly' == $instance['date_range'] ) echo 'selected="selected"'; ?>>
				<?php _e('Weekly', 'tentblogger-top-posts'); ?>
			</option>
			<option value="monthly" <?php if ( 'monthly' == $instance['date_range'] ) echo 'selected="selected"'; ?>>
				<?php _e('Monthly', 'tentblogger-top-posts'); ?>
			</option>
			<option value="alltime" <?php if ( 'alltime' == $instance['date_range'] ) echo 'selected="selected"'; ?>>
				<?php _e('All Time', 'tentblogger-top-posts'); ?>
			</option>
		</select>
		<!-- /date range -->

		<!-- pages -->
		<div class="wrap">
			<input type="checkbox" id="<?php echo $this->get_field_id('include_pages'); ?>" name="<?php echo $this->get_field_name('include_pages'); ?>" <?php if($instance['include_pages'] == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php $this->get_field_id('include_pages'); ?>">
				<?php _e('Include Pages?', 'tentblogger-top-posts'); ?>
			</label>
		</div>
		<!-- /pages -->
		
	</fieldset>
</div>