<?php
// Add an admin menu

function wps_presentation_admin_menu() {
    add_menu_page(
        'Profile Master',
        'Profile Master',
        'manage_options',
        'wps_presentation_settings',
        'wps_presentation_settings_page',
        'dashicons-color-picker', // Icon
       30 // Position (1 for top of the menu)
    );
}
add_action('admin_menu', 'wps_presentation_admin_menu');



// Create the admin settings page
function wps_presentation_settings_page() {
    ?>
    <div class="wrap wps_adming_area">
   
      <h2><?php echo esc_html__('Profile Master Settings', 'profile-master'); ?></h2>
  
		
		<?php
        // Display success message if set
        if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
            ?>
            <div id="message" class="updated notice is-dismissible">
                <p><?php esc_html_e('Settings saved successfully!', 'profile-master'); ?></p>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    setTimeout(function () {
                        document.getElementById("message").style.display = "none";
                    }, 3000); // Hide after 3 seconds
                });
            </script>
            <?php
        }
	
        ?>

         <form method="post" action="options.php">
            <?php settings_fields('wps_presentation_options_group'); ?>
            <?php do_settings_sections('wps_presentation_settings'); ?>
            <?php submit_button(); ?>
        </form>
		
    </div>
    <?php
}
// Register and define admin settings
function wps_presentation_register_settings() {
 
//input text and URL    
    register_setting('wps_presentation_options_group', 'wps_presentation_input_one_text', 'sanitize_text_field');
    register_setting('wps_presentation_options_group', 'wps_presentation_input_one_url', 'esc_url');

    register_setting('wps_presentation_options_group', 'wps_presentation_input_two_text', 'sanitize_text_field');
    register_setting('wps_presentation_options_group', 'wps_presentation_input_two_url', 'esc_url');

    register_setting('wps_presentation_options_group', 'wps_presentation_input_three_text', 'sanitize_text_field');
    register_setting('wps_presentation_options_group', 'wps_presentation_input_three_url', 'esc_url');

    register_setting('wps_presentation_options_group', 'wps_presentation_input_four_text', 'sanitize_text_field');
    register_setting('wps_presentation_options_group', 'wps_presentation_input_four_url', 'esc_url');
//Check box to hide front End color 
register_setting('wps_presentation_options_group', 'wps_presentation_hide_frontend_color_switcher', 'sanitize_checkbox');

//Color
    register_setting('wps_presentation_options_group', 'wps_presentation_colors', 'wps_presentation_sanitize_colors');

//custom CSS
    
register_setting('wps_presentation_options_group', 'wps_presentation_bg_custom_css', 'sanitize_textarea_field');
register_setting('wps_presentation_options_group', 'wps_presentation_custom_css', 'sanitize_textarea_field');
    
    
add_settings_section('wps_presentation_section', 'All Settings', 'wps_presentation_section_callback', 'wps_presentation_settings');
     
    // Add fields for Input One
    add_settings_field('wps_presentation_input_one_text', 'Input One Text', 'wps_presentation_input_one_text_callback', 'wps_presentation_settings', 'wps_presentation_section');
    add_settings_field('wps_presentation_input_one_url', 'Input One URL', 'wps_presentation_input_one_url_callback', 'wps_presentation_settings', 'wps_presentation_section');

    // Add fields for Input Two
    add_settings_field('wps_presentation_input_two_text', 'Input Two Text', 'wps_presentation_input_two_text_callback', 'wps_presentation_settings', 'wps_presentation_section');
    add_settings_field('wps_presentation_input_two_url', 'Input Two URL', 'wps_presentation_input_two_url_callback', 'wps_presentation_settings', 'wps_presentation_section');

    // Add fields for Input Three
    add_settings_field('wps_presentation_input_three_text', 'Input Three Text', 'wps_presentation_input_three_text_callback', 'wps_presentation_settings', 'wps_presentation_section');
    add_settings_field('wps_presentation_input_three_url', 'Input Three URL', 'wps_presentation_input_three_url_callback', 'wps_presentation_settings', 'wps_presentation_section');

    // Add fields for Input Four
    add_settings_field('wps_presentation_input_four_text', 'Input Four Text', 'wps_presentation_input_four_text_callback', 'wps_presentation_settings', 'wps_presentation_section');
    add_settings_field('wps_presentation_input_four_url', 'Input Four URL', 'wps_presentation_input_four_url_callback', 'wps_presentation_settings', 'wps_presentation_section');
    
  
	
	// This is for color change
    
    add_settings_section('wps_presentation_color_section', 'Color Options', 'wps_presentation_color_section_callback', 'wps_presentation_settings');

      // Add color picker fields
    for ($i = 1; $i <= 12; $i++) {
        add_settings_field(
        'wps_presentation_colors_repeater',
        'Colors- First Color is Set as theme Default Color ',
        'wps_presentation_colors_repeater_callback',
        'wps_presentation_settings',
        'wps_presentation_color_section'
    );
    }
  
add_settings_field('wps_presentation_bg_custom_css', 'Add Background Class', 'wps_presentation_bg_custom_css_callback', 'wps_presentation_settings', 'wps_presentation_section');
add_settings_field('wps_presentation_custom_css', 'Add Color Class', 'wps_presentation_custom_css_callback', 'wps_presentation_settings', 'wps_presentation_section');
	
  // This is Check box 
     add_settings_field(
        'wps_presentation_hide_frontend_color_switcher',
        'Hide Frontend Color Switcher',
        'wps_presentation_hide_frontend_color_switcher_callback',
        'wps_presentation_settings',
        'wps_presentation_section'
    );
		
  
}
add_action('admin_init', 'wps_presentation_register_settings');



// Callback function for hiding the frontend color switcher checkbox
function wps_presentation_hide_frontend_color_switcher_callback() {
    $value = get_option('wps_presentation_hide_frontend_color_switcher');
    ?>
    <input type="checkbox" id="wps_presentation_hide_frontend_color_switcher" name="wps_presentation_hide_frontend_color_switcher" value="1" <?php checked(1, $value); ?> />
    <label for="wps_presentation_hide_frontend_color_switcher"><?php esc_html_e('Use as Theme Color Settings Options', 'profile-master'); ?></label>
    <?php
}

// Sanitize checkbox function
function sanitize_checkbox($input) {
    return (isset($input) && $input == 1) ? 1 : 0;
}




// Add fields for colors repeater
function wps_presentation_colors_callback() {
    $colors = get_option('wps_presentation_colors', array());
    ?>
    <label for="wps_presentation_colors"><?php esc_html_e('Repeater Color Picker:', 'profile-master'); ?></label>
    <div id="wps_presentation_colors_container">
        <?php foreach ($colors as $key => $color): ?>
            <input type="text" name="wps_presentation_colors[<?php echo $key; ?>]" class="color-picker" value="<?php echo $color; ?>" />
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" id="wps_presentation_add_color"><?php esc_html_e('Add Color', 'profile-master'); ?></button>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var colorContainer = document.getElementById('wps_presentation_colors_container');
            var addColorButton = document.getElementById('wps_presentation_add_color');

            addColorButton.addEventListener('click', function () {
                var input = document.createElement('input');
                input.type = 'text';
                input.name = 'wps_presentation_colors[]';
                input.className = 'color-picker';
                colorContainer.appendChild(input);
            });
        });
    </script>
    <?php
}

// Color Section callback
function wps_presentation_color_section_callback() {
    echo '<p>' . esc_html__('First Color Will be DEFAULT color. Check the Hide Button it will Hide fron Front Eend and This Will give the color Chagne option', 'profile-master') . '</p>';
}

// Color repeater callback
function wps_presentation_colors_repeater_callback() {
    $colors = get_option('wps_presentation_colors', array());

    echo '<div class="wps-presentation-color-repeater">';

    if (!empty($colors)) {
        foreach ($colors as $index => $color) {
            echo "<div class='color-repeater-row'>";
            echo "<input type='text' id='wps_presentation_color_$index' name='wps_presentation_colors[$index]' class='color-picker' value='$color' />";
            echo "<div class='color-picker-container' data-input-id='wps_presentation_color_$index'></div>";
            echo "<button type='button' class='button button-secondary wps_presentation_remove_color'>Remove Color</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No colors added yet.</p>";
    }

    echo "</div>";

    echo '<button type="button" class="button button-secondary" id="wps_presentation_add_color">Add Color</button>';

   
}



// Callback function for Custom CSS
function wps_presentation_custom_css_callback() {
	 echo '<p>' . esc_html__('Set css CLASS that will be change the color and Border Color', 'profile-master') . '</p>';
    $value = get_option('wps_presentation_custom_css');
    ?>
    <label for='wps_presentation_custom_css'></label>
    <textarea id='wps_presentation_custom_css' name='wps_presentation_custom_css' rows='5' cols='50'><?php echo esc_textarea($value); ?></textarea>
    <?php
}


function wps_presentation_bg_custom_css_callback() {
	 echo '<p>' . esc_html__('Set css CLASS that will be change the BACKGROUND color', 'profile-master') . '</p>';
    $value = get_option('wps_presentation_bg_custom_css');
    ?>

    <label for='wps_presentation_bg_custom_css'></label>
    <textarea id='wps_presentation_bg_custom_css' name='wps_presentation_bg_custom_css' rows='5' cols='50'><?php echo esc_textarea($value); ?></textarea>
    <?php
}




// Section callback
function wps_presentation_section_callback() {
    echo '<p>' . esc_html__('Enter the  below Input For Sidebar Presentatin:', 'profile-master') . '</p>';
	 echo '<b>' . esc_html__('If you do not want to Show keep EMPTY all the feilds', 'profile-master') . '</b>';
}


// Input One Text callback
function wps_presentation_input_one_text_callback() {
    $value = sanitize_text_field(get_option('wps_presentation_input_one_text'));

    echo "<input type='text' id='wps_presentation_input_one_text' name='wps_presentation_input_one_text' value='$value' />";
}

// Input One URL callback
function wps_presentation_input_one_url_callback() {
    $value = esc_url(get_option('wps_presentation_input_one_url'));

    echo "<input type='url' id='wps_presentation_input_one_url' name='wps_presentation_input_one_url' value='$value' />";
}

// Input Two Text callback
function wps_presentation_input_two_text_callback() {
    $value = sanitize_text_field(get_option('wps_presentation_input_two_text'));

    echo "<input type='text' id='wps_presentation_input_two_text' name='wps_presentation_input_two_text' value='$value' />";
}

// Input Two URL callback
function wps_presentation_input_two_url_callback() {
    $value = esc_url(get_option('wps_presentation_input_two_url'));
 
    echo "<input type='url' id='wps_presentation_input_two_url' name='wps_presentation_input_two_url' value='$value' />";
}

// Input Three Text callback
function wps_presentation_input_three_text_callback() {
    $value = sanitize_text_field(get_option('wps_presentation_input_three_text'));
   
    echo "<input type='text' id='wps_presentation_input_three_text' name='wps_presentation_input_three_text' value='$value' />";
}

// Input Three URL callback
function wps_presentation_input_three_url_callback() {
    $value = esc_url(get_option('wps_presentation_input_three_url'));
   
    echo "<input type='url' id='wps_presentation_input_three_url' name='wps_presentation_input_three_url' value='$value' />";
}

// Input Four Text callback
function wps_presentation_input_four_text_callback() {
    $value = sanitize_text_field(get_option('wps_presentation_input_four_text'));
 
    echo "<input type='text' id='wps_presentation_input_four_text' name='wps_presentation_input_four_text' value='$value' />";
}

// Input Four URL callback
function wps_presentation_input_four_url_callback() {
    $value = esc_url(get_option('wps_presentation_input_four_url'));
   
    echo "<input type='url' id='wps_presentation_input_four_url' name='wps_presentation_input_four_url' value='$value' />";
}