<?php

if( !class_exists('Enqueue') ) :

    class Enqueue {
        public $styles;
        public $scripts;
        public $images;
    
        public function __construct()
        {
            // Paths
            $this->styles = get_template_directory_uri() . "/assets/css/";
            $this->scripts = get_template_directory_uri() . "/assets/js/";
            $this->images = get_template_directory_uri() . "/assets/images/";
    
            add_action('wp_enqueue_scripts', array($this, 'styles'));
            add_action('wp_enqueue_scripts', array($this, 'scripts'));
        }
    
        public function styles(){
            // bootstrap css
            wp_enqueue_style('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    
            // fancyapps
            wp_enqueue_style('fancybox', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css');
    
            // carousel
            wp_enqueue_style('carousel', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.css');
    
            // Default Files
            wp_enqueue_style('style-all', $this->styles . 'style-all.min.css', '', '');

            if (is_single()) {
                wp_enqueue_style('slick', $this->styles . 'slick.min.css', '', '1.0.0');
                wp_enqueue_style('slick-theme', $this->styles . 'slick-theme.min.css', '', '1.0.0');
            }
        
        }
    
        public function scripts(){
            // bootstrap js
            wp_enqueue_script('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
    
            // fancyapps
            wp_enqueue_script('fancybox', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), '1.0', true);
            
            // carousel
            wp_enqueue_script('carousel', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.umd.js', array(), '1.0', true);

            if(is_front_page()):
                wp_enqueue_script('glide', '//cdn.jsdelivr.net/npm/@glidejs/glide', array(), '1.1', true);
                wp_enqueue_script('script-home', $this->scripts . 'script-home.js', '', '1.1', true);
            endif;
    
            // Default Files
            wp_enqueue_script('product', $this->scripts . 'slides.js', array('carousel', 'fancybox'), '1.0', true);
    
            if (is_single()) :

                if (!wp_script_is('jquery', 'enqueued')) {
                    wp_enqueue_script('jquery');
                }
                wp_enqueue_script('slick', $this->scripts . 'slick.min.js', '', '1.0', true);
                wp_enqueue_script('script-single-js', $this->scripts . 'script-single.js', array('slick'), null, true);
            endif;

            if(is_archive('equipe')) :
                wp_enqueue_script('script-lawyers', $this->scripts . 'script-lawyers.js', '', '1.0', true);
            endif;

            if(is_page_template('page-publications.php')) :
                wp_enqueue_script('glide', '//cdn.jsdelivr.net/npm/@glidejs/glide', array(), '1.1', true);
                wp_enqueue_script('script-home', $this->scripts . 'script-home.js', '', '1.1', true);
            endif;
        }
    }
    
    $Enqueue = new Enqueue();
    
endif;