<?php

add_shortcode('transporte_universitario', 'sc_transporte_universitario');

function sc_transporte_universitario ($atts, $content) {
	$atts['body'] = do_shortcode($content);

	$atts['terms'] = new CTX_Terms();
	$atts['types'] = new TypesPost();

	return Timber::compile('widgets/sc-transporte-universitario.twig', $atts);
}