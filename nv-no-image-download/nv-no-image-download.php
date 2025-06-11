<?php
/*
Plugin Name: NV - No Image Download
Description: Prevents image downloading by disabling right-click and drag-and-drop.
Version: 1.0
Author: Network Vision
Text Domain: nv-no-image-download
*/

// Inject custom JavaScript into the head section
add_action('wp_head', 'nv_no_image_download_custom_js');
function nv_no_image_download_custom_js() {
    echo '
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Disable right-click context menu
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        });

        // Disable image dragging
        const images = document.getElementsByTagName("img");
        for (let img of images) {
            img.setAttribute("draggable", "false");
            img.addEventListener("dragstart", function(e) {
                e.preventDefault();
            });
        }

        // Disable text selection (optional)
        document.addEventListener("selectstart", function(e) {
            e.preventDefault();
        });
    });
    </script>
    ';
}

// Set security headers to prevent image embedding via iframes
add_action('send_headers', 'nv_no_image_download_security_headers');
function nv_no_image_download_security_headers() {
    header('X-Frame-Options: SAMEORIGIN');
}
