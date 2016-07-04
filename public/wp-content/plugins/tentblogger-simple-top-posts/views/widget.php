<?php if(strlen(trim($widget_title)) > 0) { ?>
	<h3 class="widget-title">
		<?php echo $widget_title; ?>
	</h3>
<?php
	} // end if
		
		global $wpdb;
		$i = 0;
		
		$post_list = '<ol class="tentblogger-top-posts-list">';
		foreach($posts as $post) {
		
			$post = (array)$post;
			$post_list .= '<li>';
				$post_list .= '<a href="' . get_permalink($post['id']) . '" rel="nofollow" target="_blank">';
					$post_list .= $post['post_title'];
				$post_list .= "</a>";
			$post_list .= '</li>';
			
			// if we're at 10, get out.
			if(++$i == 5) {
				break;
			} // end if
			
		} // end foreach

		$post_list .= '</ol>';
		
		echo $post_list;
?>