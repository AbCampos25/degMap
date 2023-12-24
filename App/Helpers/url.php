<?php
class url{

    public static function redireciona($url){
        header('location:'.URL.DIRECTORY_SEPARATOR.$url);
    }
}