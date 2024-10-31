<?php


function wps_presentation_print_custom_css() {
    $custom_css = get_option('wps_presentation_custom_css');
    $bg_custom_css = get_option('wps_presentation_bg_custom_css');
    $colors = get_option('wps_presentation_colors', array());
    ?>

    <style type="text/css" id="dynamic-custom-css">
        <?php echo esc_html($custom_css); ?> {
            color: <?php echo !empty($colors) ? esc_attr($colors[0]) : 'red'; ?>;
        }
    </style>

    <style type="text/css" id="dynamic-bg-custom-css">
        <?php echo esc_html($bg_custom_css); ?> {
            background-color: <?php echo !empty($colors) ? esc_attr($colors[0]) : 'red'; ?>;
            background: <?php echo !empty($colors) ? esc_attr($colors[0]) : 'red'; ?>;
        }
    </style> <!-- Add this line -->

    <?php
}

add_action('wp_footer', 'wps_presentation_print_custom_css');



// Display links and text inputs in the footer
add_action('wp_footer', 'wps_presentation_input');

if (!function_exists('wps_presentation_input')) {
    function wps_presentation_input() {
        $live_site_link = esc_url(get_option('wps_presentation_live_site_link'));
        $support_link = esc_url(get_option('wps_presentation_support_link'));
        $buy_now_link = esc_url(get_option('wps_presentation_buy_now_link'));

        $input_one_text = sanitize_text_field(get_option('wps_presentation_input_one_text'));
        $input_one_url = esc_url(get_option('wps_presentation_input_one_url'));

        $input_two_text = sanitize_text_field(get_option('wps_presentation_input_two_text'));
        $input_two_url = esc_url(get_option('wps_presentation_input_two_url'));

        $input_three_text = sanitize_text_field(get_option('wps_presentation_input_three_text'));
        $input_three_url = esc_url(get_option('wps_presentation_input_three_url'));

        $input_four_text = sanitize_text_field(get_option('wps_presentation_input_four_text'));
        $input_four_url = esc_url(get_option('wps_presentation_input_four_url'));

        // Check if any of the input fields are empty
        if ($input_one_url || $input_two_url || $input_three_url || $input_four_url) {
            ?>
            <div class="footer-box">
                <div class="product-sidebar">
                    <div class="xs-sidebar-group info-group info-sidebar">
                        <ul class="social-links clearfix">
                            <?php if ($input_one_url): ?>
                                <li><a href="<?php echo $input_one_url; ?>" target="_blank"><i class="icon fa fa-desktop"></i><span><?php echo $input_one_text; ?></span></a></li>
                            <?php endif; ?>
                            <?php if ($input_two_url): ?>
                                <li><a href="<?php echo $input_two_url; ?>" target="_blank"><i class="icon fa fa-life-ring"></i><span><?php echo $input_two_text; ?></span></a></li>
                            <?php endif; ?>
                            <?php if ($input_three_url): ?>
                                <li><a href="<?php echo $input_three_url; ?>" target="_blank"><i class="icon fa fa-shopping-basket"></i><span><?php echo $input_three_text; ?></span></a></li>
                            <?php endif; ?>
                            <?php if ($input_four_url): ?>
                                <li><a href="<?php echo $input_four_url; ?>" target="_blank"><i class="icon fa fa-cogs"></i><span><?php echo $input_four_text; ?></span></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        }       
    }
}




$hide_frontend_color_switcher = get_option('wps_presentation_hide_frontend_color_switcher');

if (!$hide_frontend_color_switcher) {
   
// Display links and text inputs in the footer
add_action('wp_footer', 'wps_presentation_input_color');

if (!function_exists('wps_presentation_input_color')) {
    function wps_presentation_input_color() {
        $colors = get_option('wps_presentation_colors', array());
        $custom_css = get_option('wps_presentation_custom_css');

        // Check if any color is set
        if (!empty($colors)) {
            ?>
            <style>
                <?php foreach ($colors as $key => $color): ?>
                    #color<?php echo $key + 1; ?> {
                        background-color: <?php echo $color; ?>;
                    }
                <?php endforeach; ?>
            </style>
            <?php
        }

        echo '<div class="switcher">';
  
		echo '<div class="platte"><img class="fa-cog" src="' . plugin_dir_url( __FILE__ ) . 'img/color.png" alt="Color Palette"></div>';

        echo '<div class="colors-outer primary-color">';

        foreach ($colors as $key => $color) {
            echo '<div class="box" title="color' . ($key + 1) . '" id="color' . ($key + 1) . '">' . esc_html__('Color', 'profile-master') . ' ' . ($key + 1) . '</div>';
        }

        echo '</div>';
        echo '</div>';

        // Add an element to the head for custom CSS
        echo '<style id="dynamic-custom-css"></style>';
    }
}
	
}