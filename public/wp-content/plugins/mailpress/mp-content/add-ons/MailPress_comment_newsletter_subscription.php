<?php
if (class_exists('MailPress') && !class_exists('MailPress_comment_newsletter_subscription') )
{
/*
Plugin Name: MailPress_comment_newsletter_subscription
Plugin URI: http://blog.mailpress.org/tutorials/add-ons/comment_newsletter_subscription/
Description: Subscribe to a default newsletter from comment form   (<span style='color:red;'>required !</span> <span style='color:#D54E21;'>Newsletter</span> add-on)
Version: 5.4.4
*/

class MailPress_comment_newsletter_subscription
{
	const option_name = 'MailPress_comment_newsletter_subscription';

	public static $mp_user_id = false;

	function __construct()
	{
// for wordpress hooks
// for comment
		add_action('comment_form', 				array(__CLASS__, 'comment_form'));
		add_action('comment_post', 				array(__CLASS__, 'comment_post'), 1, 1);

// for wp admin
		if (is_admin())
		{
		// for link on plugin page
			add_filter('plugin_action_links', 			array(__CLASS__, 'plugin_action_links'), 10, 2 );
		// for settings general
			add_action('MailPress_settings_general', 		array(__CLASS__, 'settings_general'), 40);
			add_action('MailPress_settings_general_update',	array(__CLASS__, 'settings_general_update'));
		}
	}

////	Plugin  ////

	public static function comment_form($post_id) 
	{
		$txtsubcomment = __("Notify me of new posts via email.", MP_TXTDOM);

		$settings 	= get_option(self::option_name);
		$nls 		= MP_Newsletter::get_active();
		if (!isset($nls[$settings['default']])) return;

		$email 	= MP_WP_User::get_email();

		if (is_email($email))
		{
			$mp_user_id = MP_User::get_id_by_email($email);
			if ($mp_user_id)
			{
				$subscriptions = MP_Newsletter::get_object_terms($mp_user_id);
				if (isset($subscriptions[$settings['default']])) return;
			}
		}
?>
<!-- start of code generated by MailPress -->
<div class='MailPressCommentNewsletterform' style='clear:both;'>
	<label for='MailPress_subscribe_to_comment_newsletter'>
		<input class='MailPressCommentNewsletterformCheckbox' name='MailPress[subscribe_to_comment_newsletter]' id='MailPress_subscribe_to_comment_newsletter' type='checkbox' style='margin:0;padding:0;width:auto;'<?php checked( isset($settings['checked']) ); ?> />
		<span><?php echo $txtsubcomment; ?></span>
	</label>
</div>
<!-- end of code generated by MailPress -->
<?php
	}

	public static function comment_post($id) 
	{
		global $wpdb, $comment;

		$comment 	= $wpdb->get_row("SELECT * FROM $wpdb->comments WHERE comment_ID = $id LIMIT 1");
		if ('spam' == $comment->comment_approved) return;

		$name 	= $comment->comment_author;

		$settings 	= get_option(self::option_name);
		$nls 		= MP_Newsletter::get_active();
		if (!isset($nls[$settings['default']])) return;

		$email 	= MP_WP_User::get_email();

		if (is_email($email))
		{
			$mp_user_id = MP_User::get_id_by_email($email);
			if ($mp_user_id)
			{
				MP_User::set_status($mp_user_id, 'active');
				$subscriptions = MP_Newsletter::get_object_terms($mp_user_id);
				if (isset($subscriptions[$settings['default']])) return;
			}
			else
			{
				if (isset($_POST['MailPress']['subscribe_to_comment_newsletter']))
				{
					$mp_user_id = MP_User::insert($email, $name, array('status' => 'active'));
					if (!$mp_user_id) return;
					self::$mp_user_id = $mp_user_id;
					add_filter('MailPress_user_already_inserted', array(__CLASS__, 'user_already_inserted'), 1 );
				}
			}
			$subscriptions[$settings['default']] = $settings['default'];
			MP_Newsletter::set_object_terms($mp_user_id, $subscriptions);
		}
	}

	public static function user_already_inserted()
	{
		return self::$mp_user_id;
	}

////  ADMIN  ////
////  ADMIN  ////
////  ADMIN  ////
////  ADMIN  ////

// for link on plugin page
	public static function plugin_action_links($links, $file)
	{
		return MailPress::plugin_links($links, $file, plugin_basename(__FILE__), 'general');
	}

// for settings general
	public static function settings_general()
	{
		$settings = get_option(self::option_name);
		$args = array(	'htmlname' 			=> 'comment_newsletter_subscription[default]', 
					'admin' 			=> true, 
					'type' 			=> 'select',
					'selected' 		=> (isset($settings['default'])) ? $settings['default'] : '',
		);
?>
			<tr>
				<th class='thtitle'><?php _e('Comment Newsletter subscription', MP_TXTDOM); ?></th>
        <td></td>
			</tr>
			<tr class='mp_sep'>
				<th><?php _e('Default Newsletter', MP_TXTDOM); ?></th>
				<td style='padding:0;'>
					<table>
						<tr>
							<td>
								<?php echo MailPress_newsletter::get_checklist(false, $args); ?>
							</td>
							<td>
								&#160;<?php _e('checked by default', MP_TXTDOM); ?>&#160;
								<input type='checkbox' name='comment_newsletter_subscription[checked]'<?php checked( (isset($settings['checked'])) ); ?> />
							</td>
						</tr>
					</table>
				</td>
			</tr>
<?php
	}

	public static function settings_general_update()
	{
		update_option (self::option_name, $_POST['comment_newsletter_subscription']);
	}
}
new MailPress_comment_newsletter_subscription();
}