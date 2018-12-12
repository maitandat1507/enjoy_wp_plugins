<?php
/*
Plugin Name: Car Article
Description: Car Article
Version: 1
Author: EAS
Author URI: 
*/

// function to create the DB / Options / Defaults                   
function car_article_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "school";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = " CREATE TABLE `gn_articles` (
              `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `delete_flag` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: available\r\n1: deleted',
              `appraisal` tinyint(4) DEFAULT NULL COMMENT '0: not verify\r\n1: verified',
              `maker_id` int(10) UNSIGNED NOT NULL COMMENT 'master maker',
              `car_id` int(10) UNSIGNED NOT NULL COMMENT 'master model of car',
              `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `bodytype` int(11) DEFAULT NULL COMMENT '0：Sedans 1：Wagons 2：SUVs 3：Van&MiniVans 4：Buses 5：Coupes 6：Hatchs 7：Convertibles 8：Trucks 9：Mini Vehicles',
              `price` decimal(13,0) NOT NULL COMMENT 'price not include tax\r\nTHB',
              `year_model` int(11) NOT NULL COMMENT 'calendar, model car',
              `meter` int(11) NOT NULL COMMENT 'mileage of car',
              `exhaust` int(11) NOT NULL COMMENT 'Engine displacement ',
              `color` int(10) UNSIGNED NOT NULL COMMENT 'Color of car',
              `clid` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'delaer ID',
              `handle` tinyint(4) NOT NULL COMMENT 'Steering wheel\r\n0: Left 1: Right',
              `drive` tinyint(4) NOT NULL COMMENT 'Drive system\r\n0：FF 1：FR 2：MR 3：RR 4：4WD 99：Other',
              `fuel` tinyint(4) NOT NULL COMMENT 'Fuel\r\n0: Gasoline 1: Diesel 2: Hybrid 3: EV (PHEV) 99: Othe',
              `door` tinyint(4) DEFAULT NULL COMMENT 'Door\r\n0: 2 door 1: 3 door 2: 4 door 3: 5 door 99: other',
              `trans` tinyint(4) NOT NULL COMMENT 'Transmission\r\n0：MT 1：AT 2：CVT 99：Other',
              `owner` tinyint(4) DEFAULT NULL COMMENT '0: No, 1: 1 Owner, 2: 2 Owner, 3: 3 Owner',
              `eval_ext` tinyint(4) DEFAULT NULL COMMENT 'Goo Inspection Exterior score \r\n5: ★ ★ ★ ★ ★ ~ 1: ★\r\n0: Unverified',
              `eval_int` tinyint(4) DEFAULT NULL COMMENT 'Goo Inspection Interior score\r\n5: ★ ★ ★ ★ ★ ~ 1: ★\r\n0: Unverified',
              `eval_eng` tinyint(4) DEFAULT NULL COMMENT 'Goo Inspection Engine\r\n5: Normal 4: Maintenance required\r\n0: Unverified',
              `eval_frm` tinyint(4) DEFAULT NULL COMMENT 'Goo Inspection Repair History\r\n5: None 4: Mild 3: Medium 2: Severe\r\n0: Unverified',
              `sheet_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Goo Inspection',
              `media` tinyint(4) DEFAULT NULL COMMENT 'Banner\r\n0',
              `country` smallint(6) DEFAULT NULL COMMENT 'National flag\r\n66:ThaiLand',
              `efpack` tinyint(4) NOT NULL COMMENT '0: Available 1: Not available',
              `airbag` tinyint(4) DEFAULT NULL COMMENT '0:no,1:yes',
              `abs` tinyint(4) DEFAULT NULL COMMENT 'ABS\r\n0:no,1:yes',
              `esc` tinyint(4) DEFAULT NULL COMMENT 'Anti-lock braking system\r\n0:no,1:yes',
              `slidedoor` tinyint(4) DEFAULT NULL COMMENT 'Slide door\r\n0:no,1:yes',
              `navi` tinyint(4) DEFAULT NULL COMMENT 'Navigation \r\n0:no,1:yes',
              `tv` tinyint(4) DEFAULT NULL COMMENT 'TV\r\n0:no,1:yes',
              `dvd` tinyint(4) DEFAULT NULL COMMENT 'DVD\r\n0:no,1:yes',
              `rearmon` tinyint(4) DEFAULT NULL COMMENT 'Rear seat Monitor\r\n0:no,1:yes',
              `compact_disc` tinyint(4) DEFAULT NULL COMMENT 'compact_dics (cd)\r\n0:no,1:yes',
              `bluetooth` tinyint(4) DEFAULT NULL COMMENT 'Restore Bluetooth\r\n0:no,1:yes',
              `usb` tinyint(4) DEFAULT NULL COMMENT 'Restore USB\r\n0:no,1:yes',
              `thdsheet` tinyint(4) DEFAULT NULL COMMENT '3 rows of seats\r\n0:no,1:yes',
              `pwrsheet` tinyint(4) DEFAULT NULL COMMENT 'Power seat\r\n0:no,1:yes',
              `wheelalm` tinyint(4) DEFAULT NULL COMMENT 'Aluminum wheels\r\n0:no,1:yes',
              `smartkey` tinyint(4) DEFAULT NULL COMMENT 'Smart Key\r\n0:no,1:yes',
              `imobi` tinyint(4) DEFAULT NULL COMMENT 'Anti-theft system\r\n0:no,1:yes',
              `backcam` tinyint(4) DEFAULT NULL COMMENT 'Back camera\r\n0:no,1:yes',
              `autocruise` tinyint(4) DEFAULT NULL COMMENT 'Autocruise control\r\n0:no,1:yes',
              `hid` tinyint(4) DEFAULT NULL COMMENT 'HID Headlight\r\n0:no,1:yes',
              `elereargate` tinyint(4) DEFAULT NULL COMMENT 'Electric tail gate\r\n0:no,1:yes',
              `backaircon` tinyint(4) DEFAULT NULL COMMENT 'Rear-seat air conditioning\r\n0:no,1:yes',
              `nosmoke` tinyint(4) DEFAULT NULL COMMENT 'No‐smoking car\r\n0:no,1:yes',
              `chkrecord` tinyint(4) DEFAULT NULL COMMENT 'Log book\r\n0:no,1:yes',
              `aero` tinyint(4) DEFAULT NULL COMMENT 'Automotive Aerodynamic\r\n0:no,1:yes',
              `newcar` tinyint(4) DEFAULT NULL COMMENT 'Inherit new-car warranty\r\n0:no,1:yes',
              `lifecare` tinyint(4) DEFAULT NULL COMMENT 'Wheelchair Van\r\n0:no,1:yes',
              `json_sync` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `alias` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB $charset_collate;

            ALTER TABLE `gn_articles`
                MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
            COMMIT;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'car_article_options_install');

//menu items
add_action('admin_menu','car_article_modifymenu');
function car_article_modifymenu() {
    
    //this is the main item for the menu
    add_menu_page('Schools', //page title
    'Car Article', //menu title
    'manage_options', //capabilities
    'car-article', //menu slug
    'car_article_list' //function
    );
    
    //this is a submenu
    add_submenu_page('car_article_list', //parent slug
    'Add New Car Article', //page title
    'Add New', //menu title
    'manage_options', //capability
    'car-article-create', //menu slug
    'car_article_create'); //function
    
    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, //parent slug
    'Update Car Article', //page title
    'Update', //menu title
    'manage_options', //capability
    'car-article-update', //menu slug
    'car_article_update'); //function

    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, //parent slug
    'View Car Article', //page title
    'Update', //menu title
    'manage_options', //capability
    'car-article-view', //menu slug
    'car_article_view'); //function
}

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'src/car_article_list.php');
require_once(ROOTDIR . 'src/car_article_create.php');
require_once(ROOTDIR . 'src/car_article_update.php');
require_once(ROOTDIR . 'src/car_article_view.php');

