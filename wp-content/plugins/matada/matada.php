<?php

/**
 * The matada Plugin
 *
 * matada is forum software with a twist from the creators of WordPress.
 *
 * $Id: matada.php 6686 2017-09-09 15:04:06Z johnjamesjacoby $
 *
 * @package matada
 * @subpackage Main
 */

/**
 * Plugin Name: matada
 * Plugin URI:  https://matianda.com
 * Description: Test Proto plugin
 * Author:      Mr.Matianda
 * Author URI:  https://matianda.com
 * Version:     1.0
 * Text Domain: matada
 * Domain Path: /languages/
 */


/*
 * Plugin constants
 */
if(!defined('MATADA_URL'))
    define('MATADA_URL', plugin_dir_url( __FILE__ ));
if(!defined('MATADA_PATH'))
    define('MATADA_PATH', plugin_dir_path( __FILE__ ));

/*
 * Main class
 */
/**
 * Class Matada
 *
 * This class creates the option page and add the web app script
 */
class Matada {
    /**
     * The option name
     *
     * @var string
     */
    private $option_name = 'feedier_data';

    /**
     * The security nonce
     *
     * @var string
     */
    private $_nonce = 'feedier_admin';

    public $private_key = '123456';

    /**
     * Returns the saved options data as an array
     *
     * @return array
     */
    private function getData() {
        return get_option($this->option_name, array());
    }

    /**
     * Make an API call to the Feedier API and returns the response
     *
     * @param string $private_key
     * @return array
     */
    private function getSurveys($private_key)
    {

        $data = array();
        $response = wp_remote_get('https://api.feedier.com/v1/carriers/?api_key='. $private_key);

        if (is_array($response) && !is_wp_error($response)) {
        $data = json_decode($response['body'], true);
        }

        return $data;
    }

    public function addAdminScripts()
    {
        wp_enqueue_script('feedier-admin', MATADA_URL . '/assets/js/admin.js', array(), 1.0);

        $admin_options = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            '_nonce'   => wp_create_nonce($this->_nonce),
        );

        wp_localize_script('feedier-admin', 'feedier_exchanger', $admin_options);
    }

    /**
     * Matada constructor
     *
     * The main plugin actions registered for WordPress
     */
    public function __construct()
    {
        // Admin page calls:
        add_action('admin_menu', array($this, 'addAdminMenu'));
        add_action('wp_ajax_store_admin_data', array($this, 'storeAdminData'));
        add_action('admin_enqueue_scripts', array($this, 'addAdminScripts'));
    }

    /**
     * Add the Matianda label to the WP Admin Sidebar Menu
     */
    public function addAdminMenu()
    {
        add_menu_page(
            __('Matada', 'feedier'),
            __('Matada Sidebar', 'feedier'),
            'manage_options',
            'matada',
            array($this, 'adminLayout'),
            ''
        );
    }

    /**
     * Output the Admin Dashboard layout containing the form with all its options
     *
     * @return void
     */
    public function adminLayout()
    {
        $data = $this->getData();

        $protoAdminDb = new wpdb('root','123456','proto_admin_tl','localhost');
        $clients = $protoAdminDb->get_results("select id, coname from gn_clients where coname <> ''");

        // echo "<ul>";
        // foreach ($clients as $client) :
        //    echo "<li>".$client->id. " : " . $client->coname . "</li>";
        // endforeach;
        // echo "</ul>";

        ?>

        <div class="wrap">
            <h3><?php _e('Matada Add store', 'matada'); ?></h3>

            <p>
            <?php _e('You can get your Feedier API settings from your <b>Integrations</b> page.', 'matada'); ?>
            </p>

            <hr>

            <h4><?php _e('Select Clients'); ?></h4>
            <select name="client">
                <?php
                foreach ($clients as $client) {
                    echo "<option value='$client->id'>$client->coname</option>";

                    ?>
                    <?php
                }
                ?>
            </select>
        </div>
    <?php
    }
}

/*
 * Starts our plugin class, easy!
 */
new Matada();