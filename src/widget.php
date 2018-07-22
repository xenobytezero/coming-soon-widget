<?php

echo __DIR__ . '/../vendor/autoload.php';

include_once(realpath(__DIR__ . '/../vendor/autoload.php'));

add_action('widgets_init', function() {
    return register_widget("ComingSoonWidget");
});

class ComingSoonWidget extends WP_Widget {

    private $default_args = array(
        'title' => 'Coming Soon...',
        'max_items' => 5
    );
    
    // --------------------------------------------------------------------

    // constructor
    function __construct() {
        
        parent::__construct(false, $name = __('Coming Soon Widget', 'coming_soon_widget') );
    
        // Register the resources for this widget
        //add_action('init', array( $this, 'load_widget_resources' ));
    }

    // --------------------------------------------------------------------

    private function load_widget_resources(){
    

        
    }

    // --------------------------------------------------------------------

    // widget form creation
    function form($instance) {      

        // get the values mixed with the defaults
        $opts = wp_parse_args($instance, $this->default_args);

        WidgetSupport\Form::render_form_option($this, 'title', 'Title', $opts);
        WidgetSupport\Form::render_form_option($this, 'max_items', 'Maximum Items', $opts);

    }


}





?>