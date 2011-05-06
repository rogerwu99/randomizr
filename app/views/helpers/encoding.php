<?php

class EncodingHelper extends Helper
{
    function db_to_html($string)
    {
         $out =  mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');
         return $out;   
    }    
    
}



?>