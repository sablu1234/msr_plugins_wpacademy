<?php
function msr_settings_init() {
	// register a new setting for "msrplugin" page
	register_setting('msrplugin', 'msr_setting_field_txt');
	register_setting('msr_plugin_sub', 'msr_setting_field_checkbox');

	// register a new section in the "msrplugin" page
	add_settings_section(
		'msr_settings_section_general',
		'General Settings', 
        'msr_settings_section_general_callback',
		'msrplugin'
	);
	add_settings_section(
		'msr_settings_section_misc',
		'Misc Settings', 
        'msr_settings_section_misc_callback',
		'msr_plugin_sub'
	);

	// register a new field in the "wporg_settings_section" section, inside the "msrplugin" page
	add_settings_field(
		'msr_settings_field_1',
		'Text Field', 
        'msr_txt_settings_field_callback',
		'msrplugin',
		'msr_settings_section_general'
	);
	add_settings_field(
		'msr_settings_field_2',
		'checkbox Field', 
        'msr_checkbox_settings_field_callback',
		'msr_plugin_sub',
		'msr_settings_section_misc'
	);
}

/**
 * register wporg_settings_init to the admin_init action hook
 */
add_action('admin_init', 'msr_settings_init');

/**
 * callback functions
 */

// section content cb
function msr_settings_section_general_callback() {
	echo '<p>Manage main plugin Settings.</p>';
}
// section content cb
function msr_settings_section_misc_callback() {
}

// field content cb
function msr_txt_settings_field_callback() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option('msr_setting_field_txt');
	// output the field
	?>
	<input type="text" name="msr_setting_field_txt" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
// field checkbox cb
function msr_checkbox_settings_field_callback() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option('msr_setting_field_checkbox');
	// output the field
	?>
	<input type="checkbox" name="msr_setting_field_checkbox" <?php echo ($setting == 'on' ? 'checked' : '' )?>>
    <?php
}