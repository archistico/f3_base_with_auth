<?php
namespace App;

class Utility
{
    public static function CleanString($testo)
    {
        $testo = str_replace('"', "", $testo);
        $testo = str_replace("'", "", $testo);
        return $testo;
    }
}
