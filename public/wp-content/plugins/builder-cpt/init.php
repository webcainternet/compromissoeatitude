<?php
/*
	Plugin Name:  Builder Depreciated CPT
	Plugin URI:   http://themify.me/builder
	Version:      1.0.0
	Author:       Themify
	Description:  This plugin re-enables the Portfolio, Testimonial, Highlight and Slider post types that used to be in Builder.
	Text Domain:  

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

add_filter( 'builder_is_portfolio_active', '__return_true' );
add_filter( 'builder_is_testimonial_active', '__return_true' );
add_filter( 'builder_is_highlight_active', '__return_true' );
add_filter( 'builder_is_slider_active', '__return_true' );