<?php
/**
 *
 * WordPress plugin that adds issue tracker system with admin and public-side tools
 *
 * @author                  Gilad Ehven
 * @copyright               2018 Gilad Ehven (Ehventerprise LLC)
 * @license                 GNU General Public License 2.0+
 * @link                    https://github.com/GiladEhven/wp-yuckapoo
 * @package                 WpYuckapoo
 * @since                   0.1.0
 *
 * @wordpress-plugin
 *
 * Plugin Name:             WP Yuckapoo
 *
 * Author:                  Gilad Ehven
 * Author URI:              http://gilad-ehven.com
 * Contributors:            Mihal Ehven (Ehventerprise LLC)
 * Description:             This plugin adds an issue tracker system with admin and public-side tools.
 * Domain Path:             /languages
 * License:                 GNU General Public License 2.0+
 * License URI:             http://www.gnu.org/licenses/gpl-2.0.txt
 * Network:                 False
 * Plugin URI:              https://github.com/GiladEhven/wp-yuckapoo
 * Privacy Policy:          https://gilad-ehven.com/privacy/
 * Terms of Use:            https://gilad-ehven.com/terms/
 * Text Domain:             wp-yuckapoo
 * Version:                 0.1.0
 *
 */

	namespace Ehven\Gilad\WordPress\Plugins\WpYuckapoo;

	if ( ! defined( 'ABSPATH' ) ) exit( 'Nothing to see here. Go <a href="/">home</a>.' );




		// ------------------------------------------------------------------------------------- //
		$autoload_file = __DIR__ . '/vendor/autoload.php'; if ( file_exists( $autoload_file ) ) { require_once( $autoload_file );
		// ------ START TEMP BLOCK ------------------------------------------------------------- //
		$whoops_error_page = new \Whoops\Handler\PrettyPageHandler();
		$whoops_error_page->setEditor( 'sublime' );

		$whoops_app = new \Whoops\Run;
		$whoops_app->pushHandler( $whoops_error_page );
		$whoops_app->register();
		// ------ END TEMP BLOCK --------------------------------------------------------------- //
		// ------ ALL CLASS LOGIC HERE --------------------------------------------------------- //
		} else {
			add_action( 'admin_notices', function() {
				$plugin_data = get_plugin_data( __FILE__ );
				$plugin_name = $plugin_data['Name'];
				?>
				<div class="notice notice-error">
					<p><?php _e( 'The <em>' . $plugin_name . '</em> plugin appears to be damaged or malfunctioning. Contact your webmaster for assistance immediately.', 'do-not-commit' ); ?></p>
				</div>
				<?php
			} );
		}
		// ------------------------------------------------------------------------------------- //



    if ( ! class_exists( __NAMESPACE__ . 'Plugin_Core' ) ) {

        class Plugin_Core {

            private $plugin_name;

            private $plugin_version;

            public static $object_counter = 0;

            public function __construct() {

                if ( is_admin() ) {

                	// Before activation, check for compatible environment before allowing activation:

                	//  ~ verify_kosher_environment()

                	//     - Composer (vendor + lock)

                	//     - Compatible environment (PHP + WP)

                	// Once active, check for continuing compatibility or deactivate plugin:

                	//  ~ Composer

                	//  ~ Compatibel environment?

					$user_admin_php       = plugins_url( '/user/admin.php', __FILE__ );
                    if ( file_exists( $user_admin_php ) ) require_once( $user_admin_php );

                } else {

                    require_once( plugins_url(  ) . '/public/php/class-public-resources.php' );

                    $public_resources     = new Public_Resources;

					$user_public_php      = plugins_url( '/user/public.php', __FILE__ );
                    if ( file_exists( $user_public_php ) ) require_once( $user_public_php );

                }

                if ( is_customize_preview() ) {

					$user_customizer_php  = plugins_url( '/user/customizer.php', __FILE__ );
                    if ( file_exists( $user_customizer_php ) ) require_once( $user_customizer_php );

                }

                self::$object_counter++;

                $this->set_plugin_name();
                $this->set_plugin_version();

            }

            public function get_plugin_name() {
                return $this->plugin_name;
            }

            public function get_plugin_version() {
                return $this->plugin_version;
            }

            protected function set_plugin_name() {
                $plugin_array = get_plugin_data( __FILE__, $markup = false, $translate = false );
                $this->plugin_name = $plugin_array[ 'Name' ];
            }

            protected function set_plugin_version() {
                $plugin_array = get_plugin_data( __FILE__, $markup = false, $translate = false );
                $this->plugin_version = $plugin_array[ 'Version' ];
            }

            protected function verify_kosher_environment() {

            	$composer_autoloader = __DIR__ . '/vendor/autoload.php';
            	$composer_directory  = __DIR__ . '/vendor/';
            	$composer_load_file  = __DIR__ . 'composer.json';
            	$composer_lock_file  = __DIR__ . 'composer.lock';

            	$verify_composer = 0;
            	$verify_composer = 0;

            	$kosher_issues = array();
            	if ( ! file_exists( $composer_autoloader ) ) $kosher_issues[] = 'Composer is not installed or damaged.';
            }

        }

    }

    $plugin_core = new Plugin_Core();
