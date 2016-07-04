<?php	
	$options = get_option( 'upzslider_options' );
		if($intertype!=null && $intertype!='') {
		$slider_type = $intertype;
		}
		else {
		$slider_type = $options['slider-type'];
		}
		if($interid!=null && $interid!='') {
		$slider_cat_id = $interid;
		}
		else {
		$slider_cat_id = $options['slider-category-id'];
		}
		$slider_view_number = $options['slider-view-number'];
		$slider_title_max_char = $options['slider-title-max-char'];
		$slider_title_thumb_max_char = $options['slider-title-thumb-max-char'];
		if (($slider_title_thumb_max_char==NULL) || ($slider_title_thumb_max_char=="")) { $slider_title_thumb_max_char = $slider_title_max_char; }
		$slider_desc_max_char = $options['slider-desc-max-char'];

	if($options['slider-fetch']!=null)
		$slider_fetch = $options['slider-fetch'];
	elseif($options['slider-fetch']==0)
		$slider_fetch = $slider_view_number;
	else
		$slider_fetch = 10;		

	if(($slider_type==1) || ($slider_type==3)) {
	$allinfos = slider_getinfo_by_cat($slider_cat_id,$slider_view_number,$slider_fetch,$slider_title_max_char,$slider_title_thumb_max_char,$slider_desc_max_char);
	}
	else {
	$allinfos = slider_getpages($slider_cat_id,$slider_view_number,$slider_title_max_char,$slider_title_thumb_max_char,$slider_desc_max_char);
	}
	$permalist = $allinfos[0];
	$titlelist = $allinfos[1];
	$thumbtitlelist = $allinfos[2];
	$contentlist = $allinfos[3];
	$thumb = $allinfos[4];
	$thumb_mini = $allinfos[5];
	
if((($options['slider-display-adv-options'])==0 || ($options['slider-display-adv-options'])==1 || ($options['slider-display-adv-options'])==2)&& ($options['slider-display-thumb']!=true)) {
	?>
	<div id="featured-navi" class="upzslider">
		<?php if($options['slider-display-adv-options']==0) { ?>
		<a href="#"><span id="previousslide"></span></a>
		<a href="#"><span id="nextslide"></span></a>
		<?php
		}
		if(($options['slider-display-adv-options']==1)||($options['slider-display-adv-options']==2)) { ?>
		<div id="nav-featured" <?php if($options['slider-display-adv-options']==2) { echo 'class="bubbles-nav upzslider"'; } else { echo 'class="upzslider"'; } ?>></div>
		<?php
		}
	}
	?>
<?php if($options['slider-parallax-enable']==true) { ?>
	<div id="featured_parallax" class="upzslider">	
		<?php
		for($p=0;$p<sizeof($permalist);$p++) {
		?>
		<div class="featured_parallax_container upzslider">
			<?php
				if (($options['slider-display-title'])==true) {
					echo "<h2><a href=\"$permalist[$p]\" >$titlelist[$p]</a></h2>";
				}
				if(($options['slider-display-desc'])==true) {
					echo "<p><a href=\"$permalist[$p]\" >$contentlist[$p]</a></p>";
				}
			?>
		</div>
		<?php
		}
		?>
	</div>
<?php } ?>
<div id="featured" class="upzslider">
<?php
if(($options['slider-display-thumb'])==true)
	{ ?>
	<ul id="upz-slideshow-navigation">	
	<?php
		for($i=0;$i<sizeof($permalist);$i++) {
		
					echo "<li id=\"nav-fragment-$i\">";
		
					if($options['slider-linksonthumb']==true) {
						echo "<a href=\"$permalist[$i]\" onclick=\"window.open('$permalist[$i]','_self');\">";
					}
					
					echo "$thumb_mini[$i]";
					if (($options['slider-display-title'])==true) {
						echo "<span>$thumbtitlelist[$i]</span>";
					}
				
					if($options['slider-linksonthumb']==true) {
						echo "</a>";
					}
				
					echo "</li>";
		}
	?>
	</ul>
	<div id="upz-slideshow-display">
	<?php
	}
for($j=0;$j<sizeof($permalist);$j++) {

				echo "<div id=\"fragment-$j\" class=\"fragment-slide\" style=\"\"><a href=\"$permalist[$j]\" >$thumb[$j]</a>";
				
				if (($options['slider-display-title'])==true || ($options['slider-display-desc'])==true) {
					if($options['slider-parallax-enable']==false) {
						echo "<div class=\"info\">";
						if (($options['slider-display-title'])==true) {
							echo "<h2><a href=\"$permalist[$j]\" >$titlelist[$j]</a></h2>";
						}
						if(($options['slider-display-desc'])==true) {
								echo "<p><a href=\"$permalist[$j]\" >$contentlist[$j]</a></p>";
						}
						echo "</div>";
					}
				}
				
				echo "</div>";
	}

	
	if(($options['slider-display-thumb'])==true)
	{ ?>
	</div>
	<?php
	}
	?>
</div>
<?php
if((($options['slider-display-adv-options'])==0 || ($options['slider-display-adv-options'])==1 || ($options['slider-display-adv-options'])==2)&& ($options['slider-display-thumb'])!=true) {
	?>
	</div>
	<div style="clear:both;"></div>
	<?php
	}
	?>