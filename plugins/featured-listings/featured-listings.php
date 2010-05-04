<?php 
/*
Plugin Name: Yeboo Featured Listings
Plugin URI: 
Description: Plugin that will generate featured listings.
Version: 0.1
Author: Programmer74
Author URI:
*/

class FeaturedListings{

	var $featured_listings = array();
	
	function __construct(){
		$this->featured_listings = $this->get_featured_listings();
	}
	
	function show_featured_listings(){
		global $re_status;
		
		$featured_listings = $this->featured_listings;
		include_once(dirname(__FILE__).'/templates/featured-listings-template.php');
	}
	
	function get_featured_listings(){
		global $wpdb;
		
		$query_listings = "SELECT 
					wposts.*, 
					listings.* 
				  FROM 
					wp_posts wposts, 
					wp_greatrealestate_listings listings 
				  WHERE 
					wposts.ID = listings.pageid 
					AND wposts.post_status = 'publish' 
					AND wposts.post_type = 'page' 
					AND featured = 'featured' 
				  ORDER BY 
					listings.ID ASC";
		
		
		$listings = $wpdb->get_results($query_listings);
		
		return $listings;
	}
	
	# Thumbnail image - <img> tag format 
	function get_listing_thumbnail($galleryid) {
		return listings_showfirstpic($galleryid,'listing-thumb');
	}
	
}


/* Display featured listing */
add_shortcode('yeboo-featured-listings','show_featured_listings_handler');
function show_featured_listings_handler(){
	$featured_listings = new  FeaturedListings();
	return $featured_listings->show_featured_listings();
}
/* End Display featured listing */


/* Load featured listing Scipts */
add_action('wp_print_scripts', 'load_featured_listing_scripts');
function load_featured_listing_scripts(){
	global $post;
	if(!is_admin() && ($post->post_content==='[yeboo-featured-listings]')){
		wp_enqueue_script( 'jquery.jcarousel.min', '/wp-content/plugins/featured-listings/js/jquery.jcarousel.min.js');
		wp_enqueue_script( 'jcarousel.control', '/wp-content/plugins/featured-listings/js/jcarousel.control.js');
	}
}
/* End Load Scripts */


/* Load featured listing Styles */
add_action('wp_print_styles', 'load_featured_listing_styles');
function load_featured_listing_styles(){
global $post;

	if((!is_admin()) && ($post->post_content==='[yeboo-featured-listings]')){
		wp_enqueue_style('jcarousel-skin', '/wp-content/plugins/featured-listings/css/jcarousel-skin.css');
	}
}
/* End Load featured listing Styles */

?>