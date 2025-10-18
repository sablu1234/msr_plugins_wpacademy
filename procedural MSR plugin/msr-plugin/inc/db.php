<?php
function msr_reactions_table(){
    global $wpdb;
	$db_version = MSR_PLUGIN_DB_VERSION;

	$table_name = $wpdb->prefix . 'reactions';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    post_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED DEFAULT NULL,
    reaction_type VARCHAR(20) NOT NULL,
    reaction_count INT UNSIGNED DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY unique_reaction (post_id, user_id, reaction_type),
    KEY post_index (post_id),
    KEY user_index (user_id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'msr_db_version', $db_version );
}



function msr_db_upgrade(){
    global $wpdb;
    $installed_ver = get_option( "msr_db_version" );
    $current_version = MSR_PLUGIN_DB_VERSION;

    if ( $installed_ver != $current_version ) {

        $table_name = $wpdb->prefix . 'post_votes';

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            name tinytext NOT NULL,
            text text NOT NULL,
            url varchar(100) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
        );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        update_option( "msr_db_version", $current_version );
    }
}

function msr_plugin_update_db_check() {
    $installed_ver = get_option( "msr_db_version" );
    $current_version = MSR_PLUGIN_DB_VERSION;
    if ( $installed_ver != $current_version ) {
        msr_db_upgrade();
    }
}
add_action( 'plugins_loaded', 'msr_plugin_update_db_check' );
