<?php

spl_autoload_register( function ($classe){
  
    $diretorios=[
        'Libraries',
        'Helpers'
    ];

    foreach ($diretorios as $diretorio) {
         $load=__DIR__.DIRECTORY_SEPARATOR.$diretorio.DIRECTORY_SEPARATOR.$classe.'.php';
         if (file_exists($load)) {
             require_once ($load);
         }
    }

});