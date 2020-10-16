<?php

namespace App\Services;

class Math
{

    public static function analiseCombinatoria($elements, $group)
    {
        $base = $elements - $group;
        $fatorial = [];
        for($i = $elements; $i > $base; $i--) {
            $fatorial[] = $i;
        }
        $result = 0;
        for($i = 0; $i <= count($fatorial); $i++) {
            if($i == 0) {
                if(array_key_exists($i + 1, $fatorial)) {
                    $result += ($fatorial[$i] * $fatorial[$i + 1]);
                }
            } else {
                if(array_key_exists($i + 1, $fatorial)) {
                    $result = $result * $fatorial[$i + 1];
                }
            }
        }
        return $result;
    }

    public static function generateCode($size = 7)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $input_length = strlen($chars);
        $random_string = '';
        for ($i = 0; $i < $size; $i++) {
            $random_character = $chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
}
