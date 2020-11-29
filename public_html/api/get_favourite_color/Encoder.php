<?php

class Encoder
{
    private static array $key = array(5,-14,31,-9,3);

    public static function decrypt(string $input)
    {
        $output = "";
        $keyIdx = 0;
        for ($i = 0; $i < strlen($input); $i++)
        {
            $output .= chr(ord($input{$i}) - self::$key[$keyIdx]);
            $keyIdx++;
            if ($keyIdx == count(self::$key)) 
            {
                $keyIdx = 0;
            }
        }
        return $output;
    }
}