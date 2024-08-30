<?php

if( !class_exists('Theme') ) :

class Theme {

    protected $cpts;
    protected $blocks;

    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'theme_support'));
        add_filter('body_class', array ($this, 'add_slug_body_class'));
        add_filter('query_vars', array($this, 'add_query_vars_filter'));
        add_filter('upload_mimes', array($this, 'cc_mime_types'));
        add_filter('wp_check_filetype_and_ext', array($this, 'check_filetype_and_ext'), 10, 5);
        add_filter('get_the_archive_title', array($this, 'customize_archive_title' ), 10, 3);
        add_action('pre_get_posts', array($this, 'custom_posts_per_page_for_eventos'), 10, 3 );

        // Includes
        $this->cpts = get_template_directory() . '/' . 'inc/cpts/';
        $this->blocks = get_template_directory() . '/' . 'inc/blocks/';
        $this->custom_posts();
        $this->blocks();
    }

    private function custom_posts() 
    {
        require_once $this->cpts . "banner.php";
        require_once $this->cpts . "expertise.php";
        require_once $this->cpts . "team.php";
        require_once $this->cpts . "events.php";
        require_once $this->cpts . "links.php";
    }

    private function blocks() 
    {
        require_once $this->blocks . "index.php";
    }

    public function theme_support()
    {
        add_theme_support('post-thumbnails');

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // logo personalizado
        add_theme_support( 'custom-logo', 
            array(
                'height'      => 30,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );

        // Menu Register
        register_nav_menus( 
            array(
                'menu-header'   => 'Main menu',
                'menu-footer-1' => 'Footer 1',
                'menu-footer-2' => 'Footer 2'
            )
        );
    }

    public function add_slug_body_class( $classes ) 
    {
        global $post;
        
        if ( isset( $post ) ) :
            $classes[] = $post->post_type . '-' . $post->post_name;
        endif;

        return $classes;
    }

    public function add_query_vars_filter($vars)
    {
        $vars[] = "paged";
        return $vars;
    }

    public function cc_mime_types( $mimes ){
        $mimes['svg'] = 'image/svg+xml';
        $mimes['vcf'] = 'text/x-vcard';
        return $mimes;
    }

    public function check_filetype_and_ext ( $wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime ) {

		if ( ! $wp_check_filetype_and_ext['type'] ) {

			$check_filetype  = wp_check_filetype( $filename, $mimes );
			$ext             = $check_filetype['ext'];
			$type            = $check_filetype['type'];
			$proper_filename = $filename;

			if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
				$ext  = false;
				$type = false;
			}

			$wp_check_filetype_and_ext = compact( 'ext', 'type', 'proper_filename' );
		}

		return $wp_check_filetype_and_ext;

	}

    public function customize_archive_title( $title, $original_title ) {
        if(is_category() || is_archive()){
            $title = sprintf(__('%1$s', 'textdomain'), $original_title);
        }

        return $title;
    }

    public function custom_posts_per_page_for_eventos( $query ) {
        if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'eventos' ) ) {
            $query->set('posts_per_page', 2 );
        }
    }

}

$Theme = new Theme();

endif;