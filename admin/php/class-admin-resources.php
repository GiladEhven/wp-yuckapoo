<?php

	namespace Ehven\Gilad\WordPress\Plugins\WpYuckapoo;

	if ( ! defined( 'ABSPATH' ) ) exit( 'Nothing to see here. Go <a href="/">home</a>.' );

	if ( ! class_exists( __NAMESPACE__ . 'Admin_Resources' ) ) {

		class Admin_Resources {

            public static $object_counter = 0;

			public function __construct() {

				add_action( 'wp_enqueue_scripts', array( $this,'enqueue_css' ) );
				add_action( 'wp_enqueue_scripts', array( $this,'enqueue_js' ) );

                self::$object_counter++;

			}

			public function enqueue_css() {

				wp_enqueue_style(
					'gilad-wp-yuckapoo',
					plugins_url( '/admin/css/main.css', __FILE__ ),
					array(),
					null,
					'all'
				);

			}

			public function enqueue_js() {

				wp_enqueue_script(
					'gilad-wp-yuckapoo',
					plugins_url( '/admin/js/main.js', __FILE__ ),
					array(),
					null,
					true
				);

			}

		}

	}
