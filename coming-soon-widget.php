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

include_once('src/Common.php');
include_once('src/Widget.php');

// ----------------------------------------------------------------
// Timber/Twig Setup

// add namespace for templates
add_filter('timber/loader/loader', function($loader){
	$loader->addPath(__DIR__ . "/templates", "coming-soon-widget");
	$loader->addPath(ComingSoonWidget\Common::get_custom_template_base(), "coming-soon-widget-custom-templates");
	return $loader;
});

// ----------------------------------------------------------------
// Register Widget

add_action('widgets_init', function() {
    return register_widget('ComingSoonWidget\Widget');
});

?>

