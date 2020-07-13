<?php

/**
 * Toolset Types for Twig
 * Matt Pratta, 2017
 */

class TypesPost extends TimberPost {

	// Pegar posts
	public static function get ($type, $query = array()) {
		if (is_object($type)) {
			return new static($type);
		}

		if (is_array($type))
			$posts = $type;
		else
			$posts = Timber::get_posts(array_merge($query, array('post_type' => $type)));

		// Converter em tipo do Types
		foreach ($posts as $k => $p) {
			$posts[$k] = new static($p);
		}

		// Retornar
		return $posts;
	}

	public function multi ($field) {
		$field = $this->_($field);

		$r = array();
		foreach ($field as $k => $v) {
			foreach ($v as $cat) {
				$r[] = $cat;
			}
		}

		return $r;
	}

	// Child posts
	public function child ($type, $args = array()) {
		$args['post_id'] = $this->ID;
		$posts = types_child_posts ($type, $args);

		// Converte
		foreach ($posts as $k => $p) {
			$posts[$k] = new static($p);
		}

		return $posts;
	}

	// Campos Custom (wpcf-*)
	public function custom_field ($field) {
		return $this->prop ('wpcf-' . $field);
	}

	// Todas Propriedas
	public function _ ($prop) {
		if (isset($this->{'wpcf-' . $prop}))
			return $this->{'wpcf-' . $prop};
		return $this->{$prop};
	}
	public function obj ($prop) { return json_decode($this->_($prop)); }
}
$context['types'] = new TypesPost();
