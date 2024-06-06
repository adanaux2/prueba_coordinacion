/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */

/* eslint-disable camelcase */

(function ($) {
    "use strict";

    // Check if dark mode is enabled in localStorage and apply it on page load
    if (localStorage.getItem("dark-mode") === "true") {
        $("body").addClass("dark-mode");
    } else {
        $("body").removeClass("dark-mode");
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function createSkinBlock(colors, callback, noneSelected) {
        var $block = $("<select />", {
            class: noneSelected
                ? "custom-select mb-3 border-0"
                : "custom-select mb-3 text-light border-0 " +
                  colors[0].replace(/accent-|navbar-/, "bg-"),
        });

        if (noneSelected) {
            var $default = $("<option />", {
                text: "None Selected",
            });

            $block.append($default);
        }

        colors.forEach(function (color) {
            var $color = $("<option />", {
                class: (typeof color === "object" ? color.join(" ") : color)
                    .replace("navbar-", "bg-")
                    .replace("accent-", "bg-"),
                text: capitalizeFirstLetter(
                    (typeof color === "object" ? color.join(" ") : color)
                        .replace(/navbar-|accent-|bg-/, "")
                        .replace("-", " ")
                ),
            });

            $block.append($color);
        });
        if (callback) {
            $block.on("change", callback);
        }

        return $block;
    }

    var $sidebar = $(".control-sidebar");
    var $container = $("<div />", {
        class: "p-3 control-sidebar-content",
    });

    $sidebar.append($container);

    // Checkboxes

    $container.append('<h5>Customize AdminLTE</h5><hr class="mb-2"/>');

    var $dark_mode_checkbox = $("<input />", {
        type: "checkbox",
        value: 1,
        checked: $("body").hasClass("dark-mode"),
        class: "mr-1",
    }).on("click", function () {
        if ($(this).is(":checked")) {
            $("body").addClass("dark-mode");
            // Guardar la preferencia en localStorage
            localStorage.setItem("dark-mode", "true");
        } else {
            $("body").removeClass("dark-mode");
            localStorage.setItem("dark-mode", "false");
        }
    });
    var $dark_mode_container = $("<div />", { class: "mb-4" })
        .append($dark_mode_checkbox)
        .append("<span>Dark Mode</span>");
    $container.append($dark_mode_container);


    

    
    
      

    // var active_brand_color = null
    // $('.brand-link')[0].classList.forEach(function (className) {
    //   if (logo_skins.indexOf(className) > -1 && active_brand_color === null) {
    //     active_brand_color = className.replace('navbar-', 'bg-')
    //   }
    // })

    // if (active_brand_color) {
    //   $brand_variants.find('option.' + active_brand_color).prop('selected', true)
    //   $brand_variants.removeClass().addClass('custom-select mb-3 text-light border-0 ').addClass(active_brand_color)
    // }
})(jQuery);
