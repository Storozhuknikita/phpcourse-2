<?php

namespace App\services;


class StringService
{
    public function cutString($string, $length)
    {
        return mb_substr($string, 0, $length);
    }
}