<?php

add_shortcode('timeline', 'sc_timeline');
add_shortcode('timeline-item', 'sc_timeline_item');

function sc_timeline ($atts, $content) {
	$atts['body'] = do_shortcode($content);

	return Timber::compile('widgets/timeline.twig', $atts);
}

function sc_timeline_item ($atts, $content) {
	$atts['body'] = do_shortcode($content);

	return Timber::compile('widgets/timeline-item.twig', $atts);
}