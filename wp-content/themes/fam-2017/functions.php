<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
        add_image_size( 'image_grid', 700, 450, true );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;

		include ('ctx.php');

		return $context;
	}

	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new StarterSite();

function my_login_logo() { ?>
    <style type="text/css">
        body.login {
            background-color: #1c3556;
        }
        body.login div#login form#loginform {
            border-radius: 5px;
            box-shadow: 1px 2px 5px rgba(0,0,0,.5);
        }
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo-fam.svg);
            height: 70px;
            width: 278px;
            background-size: 278px 70px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
        body.login div#login p#nav,
        body.login div#login p#nav a,
        body.login div#login p#backtoblog,
        body.login div#login p#backtoblog a {
            color: #fff;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'FAM - Faculdade de Americana';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );

add_action('wp_logout','unlog');

function unlog(){
    wp_redirect( '/acesso-fam-nicom' );
    exit();
}