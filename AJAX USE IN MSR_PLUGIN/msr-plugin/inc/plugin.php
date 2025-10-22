<?php
class MSR_Plugin {
    public function __construct(){
        $this->load_dependencies();

        add_action('admin_menu', [$this, 'msr_plugin_menus']);
        add_action('init', [$this,'register_projects_post_type'], 0);
        add_action( 'admin_enqueue_scripts', [$this, 'msr_plugin_admin_scripts'] );
        add_action( 'wp_enqueue_scripts', [$this, 'msr_plugin_public_scripts'] );
    }

    private function load_dependencies(){
        require_once MSR_PLUGIN_DIR_PATH . 'inc/taxonomy.php';
        require_once MSR_PLUGIN_DIR_PATH . 'inc/metaboxes.php';
        require_once MSR_PLUGIN_DIR_PATH . 'inc/db.php'; 
        require_once MSR_PLUGIN_DIR_PATH . 'inc/admin-page.php'; 
        require_once MSR_PLUGIN_DIR_PATH . 'inc/admin-settings.php'; 
        require_once MSR_PLUGIN_DIR_PATH . 'inc/shortcodes.php'; 
        require_once MSR_PLUGIN_DIR_PATH . 'inc/voting.php'; 
    }
    /**
     * Admin Script
    */
    public function msr_plugin_admin_scripts(){
        wp_enqueue_style( 'msr-plugin-admin-css', MSR_PLUGIN_DIR_URL . 'assets/css/admin.css', '', MSR_PLUGIN_VERSION );
        wp_enqueue_script( 'msr-plugin-admin-js', MSR_PLUGIN_DIR_URL . 'assets/js/admin.js', '', MSR_PLUGIN_VERSION, true );
    }
    public function msr_plugin_public_scripts(){
        wp_enqueue_style( 'msr-plugin-public-css', MSR_PLUGIN_DIR_URL . 'assets/css/public.css', '', MSR_PLUGIN_VERSION );
        wp_enqueue_script( 'msr-plugin-public-js', MSR_PLUGIN_DIR_URL . 'assets/js/public.js', '', MSR_PLUGIN_VERSION, true );
        wp_enqueue_script( 'msr-plugin-ajax-js', MSR_PLUGIN_DIR_URL . 'assets/js/ajax.js', ['jquery'], MSR_PLUGIN_VERSION, true );
        wp_localize_script( 'msr-plugin-ajax-js', 'msr_ajax',['ajax_url' => admin_url('admin-ajax.php')] );
    }
    /**
     * Register Plugin admin menus
    */
    public function msr_plugin_menus(){
        add_menu_page(
            'MSR Plugin',
            'MSR',
            'manage_options',
            'msrplugin',
            'msr_plugin_page',
            'dashicons-admin-settings',
            10
        );
        add_submenu_page(
            'msrplugin',
            'MSR PLUGIN Sub-Menu',
            'Sub-Menu',
            'manage_options',
            'msr_plugin_sub',
            'msr_plugin_sub_page'
        );
    }

    /**
     * 
     * Register Post Type
    */
    function register_projects_post_type() {
    $labels = array(
        'name'                  => _x('Projects', 'Post Type General Name', 'msr-plugin'),
        'singular_name'         => _x('Project', 'Post Type Singular Name', 'msr-plugin'),
        'menu_name'            => __('Projects', 'msr-plugin'),
        'all_items'            => __('All Projects', 'msr-plugin'),
        'add_new_item'         => __('Add New Project', 'msr-plugin'),
        'add_new'              => __('Add New', 'msr-plugin'),
        'edit_item'            => __('Edit Project', 'msr-plugin'),
        'update_item'          => __('Update Project', 'msr-plugin'),
        'search_items'         => __('Search Project', 'msr-plugin'),
    );

    $args = array(
        'label'                 => __('Project', 'msr-plugin'),
        'labels'                => $labels,
        'supports'              => ["title","editor","thumbnail","excerpt","author","comments"],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-admin-collapse',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => false,
    );

    register_post_type('projects', $args);
}


}
new MSR_Plugin();