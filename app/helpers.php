<?php

if (! function_exists('phone_number')) {
    function phone_number($phone){
        $phone = preg_replace("[^0-9]",'',$phone);
        if(strlen($phone) != 11) return(False);
        $codeCountry = substr($phone, 0, 1);
        $prefix = substr($phone, 1, 3);
        $aNumber = substr($phone, 4, 3);
        $bNumber = substr($phone, 7, 2);
        $cNumber = substr($phone, 9, 2);
        $phone = '+'.$codeCountry.' ('.$prefix.') '.$aNumber.'-'.$bNumber.'-'.$cNumber;
        return $phone;
    }
}

if (!function_exists("mb_trim"))
{
    function mb_trim( $string )
    {
        $string = preg_replace( "/(^\s+)|(\s+$)/us", "", $string );

        return $string;
    }
}
