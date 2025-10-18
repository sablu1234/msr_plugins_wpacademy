<?php

  // Create the options page
  function msr_options_page() {
      ?>
      <div class="wrap">
          <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
          <form action="options.php" method="post">
              <?php
              settings_fields('msr_options');
              do_settings_sections('msr-settings');
              submit_button();
              ?>
          </form>
      </div>
      <?php
  }