<?php

include_once ABSPATH . 'wp-admin/includes/plugin.php';
$plugin_info = get_plugin_data( QUIRE_API_PLUGIN_FILE );

define( 'QUIRE_API_PLUGIN_VERSION', $plugin_info['Version'] );
define( 'QUIRE_API_PLUGIN_DIR', untrailingslashit( plugin_dir_path( QUIRE_API_PLUGIN_FILE ) ) );
define( 'QUIRE_API_PLUGIN_CLASSES_DIR', QUIRE_API_PLUGIN_DIR . '/classes' );

//custom post type
define( 'AGENCY_CPT', 'agency' );
define( 'ASSIGNMENT_CPT', LP_ORDER_CPT );
define( 'COURSE_CPT', LP_COURSE_CPT );
define( 'GROUP_CPT', 'group' );
define( 'PROGRESS_CPT', 'progress_tracker' );

//user role
define( 'CAREGIVER_ROLE', 'caregiver' );
define( 'AGENCY_ADMIN_ROLE', 'agency_admin' );
define( 'ADMIN_ROLE', 'administrator' );

//assignment status
define( 'ASSIGNMENT_STATUS_ACTIVE', 'active' );
define( 'ASSIGNMENT_STATUS_COMPLETED', 'completed' );

//group type
define( 'GROUP_COURSE', 'course' );
define( 'GROUP_CAREGIVER', 'caregiver' );

//course status
define( 'COURSE_STATUS_PUBLISH', 'publish' );
