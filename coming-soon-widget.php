<?php
    
/*
Plugin Name: Coming Soon Widget
Plugin URI: 
Description: 
Version: @@releaseVersion
Author: Euan Robertson
Author Email: xenobytezero@gmail.com
License:

  Copyright 2011 Euan Robertson (xenobytezero@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

include 'vendor/autoload.php';

include_once('src/widget.php');

/*

class coming_soon_widget extends WP_Widget {

    private $default_args = array(
        'title' => 'Coming Soon...',
        'max_items' => 5
    );
    
    // --------------------------------------------------------------------

    // constructor
    function coming_soon_widget() {
        
        parent::WP_Widget(false, $name = __('Coming Soon Widget', 'coming_soon_widget') );
    
        // Register the resources for this widget
        add_action('init', array( $this, 'load_widget_resources' ));
    }

    
    // --------------------------------------------------------------------
    
    function load_widget_resources(){
        
        wp_register_style(
            'csw_main_style',
            plugins_url('/css/coming-soon-widget.css', __FILE__)          
        );
        
    }
    
    // --------------------------------------------------------------------

    // widget form creation
    function form($instance) {      

        // get the values mixed with the defaults
        $opts = wp_parse_args($instance, $this->default_args);

        bt_widget_render_form_option($this, 'title', 'Title', $opts);
        bt_widget_render_form_option($this, 'max_items', 'Maximum Items', $opts);

    }

    // --------------------------------------------------------------------

    // widget update
    function update($new_instance, $old_instance) {

        $ids = array('title', 'max_items');

        return bt_widget_save_options($new_instance, $old_instance, $ids);

    }

    // --------------------------------------------------------------------

    // widget display
    function widget($args, $instance) {
        
        wp_enqueue_style('csw_main_style');

        // get the values mixed with the defaults
        $opts = wp_parse_args($instance, $this->default_args);
       
        // render before widget
        echo $args['before_widget'];

        // if there is a title then render it
        if ( !empty( $opts['title'] ) ){
            echo $args['before_title'] . apply_filters( 'widget_title', $opts['title'] ) . $args['after_title'];
        }

        // widget enclosure
        echo "<div class='coming-up-widget'><ul>";
        
        // do the query
        $query = $this->do_query($opts);

        // The Loop
        if ( $query->have_posts() ){

            while ( $query->have_posts() ) : $query->the_post();

                $image_url = bt_get_post_image_url('medium');
                $title = get_the_title();
                $date = get_the_date();
                $post_icon = bt_get_post_fontawesome_icon(get_post_type());
                $rel_tax = bt_get_relevant_taxonomy_value(get_the_id())->name;
                            
                // apply filters to the post type
                $this->render_item($image_url, $title, $date, $post_icon);


            endwhile;

        } else {
            echo '<!-- --------------------------------------------- -->';
            echo '<!-- No posts were found -->';
            echo '<!-- --------------------------------------------- -->';
        }
            
        wp_reset_postdata();
            
        echo "</ul></div>";
        echo $args['after_widget'];

    }

    // --------------------------------------------------------------------
    // --------------------------------------------------------------------
    // --------------------------------------------------------------------

    

    function do_query($opts) {
        
        $custom_query = new WP_Query(array(
            'post_status' => array('draft', 'future' ),
            'posts_per_page' => $opts['max_items'],
                        'post_type' => 'any',
                        'order' => 'ASC'
        ));

        return $custom_query;

    }

    // --------------------------------------------------------------------

    function render_item($image_url, $title, $date, $icon_element){
                
?>

        <li style='background-image:url(<?php echo $image_url ?>)'>
			<div class="background">
				<p class="title"><?php echo $title ?></p>
				<div class='info-container'>
					<p class="type"><?php echo $icon_element ?></p><p class="date"><?php echo $date ?></p>
				</div>
			</div>
        </li>
                
<?php

    }

    // --------------------------------------------------------------------

}

add_action('widgets_init', create_function('', 'return register_widget("coming_soon_widget");'));


*/
?>

