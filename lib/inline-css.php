<?php
$accent_color = sanitize_hex_color(get_theme_mod('_themename_accent_color', '#20ddae'));
$inline_styles = "
 a {
   color: {$accent_color}
 }
 :focus {
   outline-color: {$accent_color}
 }
 .c-post.sticky {
   border-left-color: {$accent_color}
 }
 button, input[type=submit], .header-nav .menu > .menu-item:not(.mega) .sub-menu .menu-item:hover a {
   background-color: {$accent_color}
 }

";