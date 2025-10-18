<?php


  
  // Register settings
  function msr_settings_init() {
      add_settings_section(
          'msr_options_section',
          __('MSR Plugin Settings', 'msr-plugin'),
          function() {
              
          },
          'msr-settings'
      );
  
      
      add_settings_field(
          'msr_default_shortcode_txt',
          __('Default Shortcode Text', 'msr-plugin'),
          function() {
              $value = get_option('msr_default_shortcode_txt');
              ?>
              <input
              type="text"
              name="msr_default_shortcode_txt"
              id="msr_default_shortcode_txt"
              value="<?php echo esc_attr($value); ?>"
              class="regular-text"
              placeholder="this is a test shortcode"
          />
              
              <?php
          },
          'msr-settings',
          'msr_options_section'
      );
  
      register_setting('msr_options', 'msr_default_shortcode_txt');

      add_settings_field(
          'msr_enable_shortcodes',
          __('Enable Shortcode', 'msr-plugin'),
          function() {
              $value = get_option('msr_enable_shortcodes');
              ?>
              <select
              name="msr_enable_shortcodes"
              id="msr_enable_shortcodes"
              class="regular-text"
          >
              <option value=""><?php _e('Select an option', 'msr-plugin'); ?></option>
              <?php
              // Example options - replace with actual options
              $options = array(
                  'yes' => __('Yes', 'msr-plugin'),
                  'no' => __('No', 'msr-plugin'),
              );
              
              foreach ($options as $option_value => $option_label) {
                  printf(
                      '<option value="%s" %s>%s</option>',
                      esc_attr($option_value),
                      selected($value, $option_value, false),
                      esc_html($option_label)
                  );
              }
              ?>
          </select>
              
              <?php
          },
          'msr-settings',
          'msr_options_section'
      );
  
      register_setting('msr_options', 'msr_enable_shortcodes');
  }
  add_action('admin_init', 'msr_settings_init');