/*
jQuery(document).ready(function($) {
    $('#wps_presentation_add_color').on('click', function() {
        var index = $('.wps-presentation-color-repeater .color-repeater-row').length;

        var newRow = '<div class="color-repeater-row">' +
            '<label for="wps_presentation_color_' + index + '">Color ' + (index + 1) + '</label>' +
            '<input type="text" id="wps_presentation_color_' + index + '" name="wps_presentation_colors[' + index + ']" class="color-picker" />' +
            '</div>';

        $('.wps-presentation-color-repeater').append(newRow);
    });
});
*/