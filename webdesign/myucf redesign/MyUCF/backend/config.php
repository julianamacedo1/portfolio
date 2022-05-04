<?php
    $_ROOT = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    $_SUBFOLDER = $_SERVER['HTTP_HOST'] == "localhost" ? "MyUCF/" : "~da400699/dig4172c/myUCF/";

    $_ROOTPATH = $_ROOT.$_SUBFOLDER;