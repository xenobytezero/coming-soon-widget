<?php

namespace ComingSoonWidget;

class Widget extends \WP_Widget {

    private $default_args = array(
        'title' => 'Coming Soon...',
        'max_items' => 5,
        'template' => ''
    );
    
    // --------------------------------------------------------------------

    // constructor
    function __construct() {
        
        parent::__construct(false, $name = __('Coming Soon Widget', 'coming_soon_widget') );

        // Register the resources for this widget
        //add_action('init', array( $this, 'load_widget_resources' ));
    }

    // --------------------------------------------------------------------

    function load_widget_resources(){

        
    }

    // --------------------------------------------------------------------

    // widget form creation
    function form($instance) {      

        // get the values mixed with the defaults
        $opts = wp_parse_args($instance, $this->default_args);

        $available_templates = \WidgetSupport\TemplateDiscovery::find_templates(
            Common::get_custom_template_base()
        );

        $template_opts = array_map(function($tmpl) {
            return [
                "name" => $tmpl["name"],
                "value" => $tmpl["path"]
            ];
        }, $available_templates);


        \WidgetSupport\Form::render_form_text_box($this, 'title', 'Title', $opts);
        \WidgetSupport\Form::render_form_text_box($this, 'max_items', 'Maximum Items', $opts);

        echo "<hr/>";

        \WidgetSupport\Form::render_form_select($this, 'template', 'Template', $opts, $template_opts);

    }

    // --------------------------------------------------------------------

    // widget display
    function widget($args, $instance) {

        // get the values mixed with the defaults
        $opts = wp_parse_args($instance, $this->default_args);

        echo '<!-- Coming Soon Widget -->';

        $posts = \Timber\Timber::get_posts([
            'post_status' => array('draft', 'future'),
            'posts_per_page' => $opts['max_items'],
            'post_type' => 'any',
            'order' => 'ASC'
        ], "\Polygen\Post");

        if (sizeof($posts) === 0) {
            
            echo '<!-- --------------------------------------------- -->';
            echo '<!-- No posts were found -->';
            echo '<!-- --------------------------------------------- -->';

            return;
        }

        $template = '@coming-soon-widget/default.twig';

        if ($opts["template"] !== ''){
            $template =  "@coming-soon-widget-custom-templates/" . $opts["template"];
        }

        $context = [
            "title" => $opts["title"],
            "posts" => $posts
        ];

        \Timber\Timber::render($template, $context);

        echo '<!-- / Coming Soon Widget -->';

    }

    // --------------------------------------------------------------------

    // widget update
    function update($new_instance, $old_instance) {
        $ids = array('title', 'max_items', 'template');
        return \WidgetSupport\Form::save_options($new_instance, $old_instance, $ids);
    }
    
    // --------------------------------------------------------------------

}
?>