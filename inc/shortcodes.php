<?php


if (!function_exists('bht_room_image')) {
	function bht_room_image($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'thumbnail_size' => 'large',
			'thumbnail_custom_dimension' => ''
		), $atts));

	}
	add_shortcode('bht_room_image', 'bht_room_image');
}


?>