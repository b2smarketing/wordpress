<?php

class CTX_Terms {
	public function get ($term) {
		return Timber::get_terms($term);
	}
}

$context['terms'] = new CTX_Terms();