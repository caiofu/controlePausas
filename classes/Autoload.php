<?php

    spl_autoload_register( function ($classe)
    {
        require "$classe.php";
    });
    /*function loader($nomeClasse)
    {
        $ext = '.php';
        $fullpath = $nomeClasse . $ext;
        if (file_exists($fullpath))
        {
            require_once $fullpath;
        }
    }
    spl_autoload_register('loader');*/