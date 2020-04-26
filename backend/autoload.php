<?php

spl_autoload_register(function ($filename) {
    $withoutApp = str_replace('App\\', '', $filename);
    require $withoutApp.'.php';
});
