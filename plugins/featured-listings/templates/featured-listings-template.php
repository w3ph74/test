<div>
	<ul id="featured-listings-slider" class="jcarousel-skin-tango">
		<?php 
			foreach($featured_listings as $listing){?>
				<li>
					<div><?php echo nextgengallery_showfirstpic($listing->galleryid);?></div>
					<div>
						<a href="<?php echo get_permalink($listing->ID); ?>" title="<?php echo  __('More about','greatrealestate') . $listing->post_title?>">
							<?php echo $listing->post_title ?>
						</a><br />
						<span style="font-size: 10px;"><?php echo $re_status[$listing->status] . " | " .  __("$","greatrealestate") . number_format($listing->listprice) ?></span>
					</div>
				</li>
		<?php
			}
		?>
	</ul>
</div>
