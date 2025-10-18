<?php

// Basic Shortcode
function msr_test_shortcode(){
    $db_value = get_option('msr_default_shortcode_txt');
    if(!empty($db_value)){
        return $db_value;
    }else{
        return 'this is a test shortcode';
    }
    
}
add_shortcode('msr_test','msr_test_shortcode');
//Usage
// [msr_test]

// Enclosing shortcode
function msr_enclosing_shortcode($atts = array(),$content){
    $html= '<a href="http://wpacademy.local/projects/e-commerce-website-development/">';
    $html .=$content;
    $html .= '</a>';
    return $html;
}
add_shortcode('MSR_TEST_ENCLOSING','msr_enclosing_shortcode');
// Usage
// [MSR_TEST_ENCLOSING]HELLO[/MSR_TEST_ENCLOSING]

// Shortcodes with Parameters
function msr_parameters_shortcode($atts = array()){
    $attrs = shortcode_atts(
		array(
			'label' => 'Button Label',
			'link' => 'http://wpacademy.local/projects/e-commerce-website-development/',
		), $atts
	);
    $html= '<a href="'.$attrs['link'].'">';
    $html .= $attrs['label'];
    $html .= '</a>';
    return $html;
}
add_shortcode('MSR_TEST_PARAM','msr_parameters_shortcode');
// Usage
// [MSR_TEST_PARAM label="my button" link="https://developer.wordpress.org/plugins/shortcodes/shortcodes-with-parameters/"]



// Shortcodes with Parameters form Magicwp
function msr_test_params_magicwp_shortcode($atts) {
    if(!empty($atts)){
         $atts = shortcode_atts(array(
        'label' => 'Button Label',
		'link' => 'http://wpacademy.local/projects/e-commerce-website-development/'
    ), $atts, 'MSR_TEST_PARAM');
    }else{
        $atts = NULL;
    }
    // Extract and merge attributes with defaults
   

    // Start output buffering
    ob_start();

    // Your shortcode logic here
    ?>
    <div class="msr-button-shortcode">
        <?php if(!empty($atts)){ ?>
        <a href="<?php echo $atts['link']?>" style="padding:10px; background-color:blue; color:white;" ><?php echo $atts['label']?></a>
        <?php }else{?>
        please assign link and label
        <?php } ?>
    </div>
    <?php

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('MSR_TEST_PARAM_MAGICWP', 'msr_test_params_magicwp_shortcode');

// Usage
// [MSR_TEST_PARAM_MAGICWP label="extended button" link="https://developer.wordpress.org/plugins/shortcodes/shortcodes-with-parameters/"]



/**
 * Project meta information
 */
function msr_project_meta_shortcode($attrs){
    $attrs = shortcode_atts(
		array(
			'id' => get_the_id(),
			'link' => 'http://wpacademy.local/projects/e-commerce-website-development/',
		), $attrs, 'PROJECT_META'
	);
    $project_url = get_post_meta($attrs['id'],'project_url', true);
    $project_completion = get_post_meta($attrs['id'],'project_completion_duration', true);
    $project_cost = get_post_meta($attrs['id'],'project_estimated_cost', true);

    $html = '<div class="project-meta" >';
        $html .= '<span><a href="'.$project_url.'">Visit Project</a></span>';
        $html .= '<span>'.$project_completion.'</span>';
        $html .= '<span>'.$project_cost.'</span>';
    $html .= '</div>';
    return $html;


}
add_shortcode('PROJECT_META','msr_project_meta_shortcode');

