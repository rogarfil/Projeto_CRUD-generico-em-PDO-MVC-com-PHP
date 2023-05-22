<?php

use Src\Models\Url;

    $modulo = Url::getURL(0);

if ($modulo == null) {
    $modulo = "home";
}

if (file_exists("src/views/" . $modulo . ".php")) :
    require "src/views/" . $modulo . ".php";
else :
    require "src/views/404.php";
endif;
