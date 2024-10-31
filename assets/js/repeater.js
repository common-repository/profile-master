jQuery(document).ready(function($) {
    function initColorPicker() {
        $('.color-picker').wpColorPicker();
    }

    function addColorRow(index) {
        var newRow = '<div class="color-repeater-row">' +
            '<label for="wps_presentation_color_' + index + '">Color ' + (index + 1) + '</label>' +
            '<input type="text" id="wps_presentation_color_' + index + '" name="wps_presentation_colors[' + index + ']" class="color-picker" />' +
            '<div class="color-picker-container" data-input-id="wps_presentation_color_' + index + '"></div>' +
            '<button type="button" class="button button-secondary wps_presentation_remove_color">Remove Color</button>' +
            '</div>';

        $('.wps-presentation-color-repeater').append(newRow);
        initColorPicker(); // Initialize the color picker for the new input
    }

    $('#wps_presentation_add_color').on('click', function() {
        var index = $('.wps-presentation-color-repeater .color-repeater-row').length;
        addColorRow(index);
    });

    $('.wps-presentation-color-repeater').on('click', '.wps_presentation_remove_color', function() {
        $(this).closest('.color-repeater-row').remove();
    });

    $('.wps-presentation-color-repeater').on('focus', '.color-picker', function() {
        var inputId = $(this).attr('id');
        var colorPickerContainer = $('.color-picker-container[data-input-id="' + inputId + '"]');

        $(this).wpColorPicker({
            change: function(event, ui) {
                $(this).val(ui.color.toString()); // Update the input field value on color change
            }
        });

        colorPickerContainer.addClass('color-picker-active');
    });

    // Initialize color picker for existing rows
    initColorPicker();
});
