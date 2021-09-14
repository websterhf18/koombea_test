<?php

namespace App\Services;

use CreditCard;

class ContactService {
    
    public static function get_cc_company($cc)
    {
        $card = CreditCard::validCreditCard($cc);
        if($card->valid){
            return $card->type;
        }else{
            return 'No valido';
        }
    }

    public static function parse_cc_number($cc){
        $newString = str_replace("-", "", $cc);
        return $newString;
    }
    public static function get_four_last($cc){
        $newString = str_replace(" ", "", $cc);
        $newString = substr($newString, -4);
        return $newString;
    }

}