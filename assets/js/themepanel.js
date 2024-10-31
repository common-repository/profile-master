document.addEventListener('DOMContentLoaded', function () {
    var colorBoxes = document.querySelectorAll('.box');
    var dynamicCustomCSS = document.getElementById('dynamic-custom-css');
    var dynamicBgCustomCSS = document.getElementById('dynamic-bg-custom-css'); // Add this line
    var colors = wpsPresentationData.colors;

    colorBoxes.forEach(function (box, index) {
        box.addEventListener('click', function () {
            changeCustomCSSColor(colors[index]);
            changeBgCustomCSSColor(colors[index]); // Add this line
        });
    });

    function changeCustomCSSColor(color) {
        if (dynamicCustomCSS) {
            dynamicCustomCSS.innerHTML = dynamicCustomCSS.innerHTML.replace(/color\s*:\s*[^;]*/g, 'color: ' + color);
        }
    }

    // Add this function
    function changeBgCustomCSSColor(color) {
        if (dynamicBgCustomCSS) {
            dynamicBgCustomCSS.innerHTML = dynamicBgCustomCSS.innerHTML.replace(/background-color\s*:\s*[^;]*/g, 'background-color: ' + color + ';');
            dynamicBgCustomCSS.innerHTML = dynamicBgCustomCSS.innerHTML.replace(/background\s*:\s*[^;]*/g, 'background: ' + color + ';');
        }
    }
});


jQuery(document).ready(function($) {
    $(".switcher .fa-cog").click(function(e) { 
        e.preventDefault();
        $(".switcher").toggleClass("active");
    });
});
