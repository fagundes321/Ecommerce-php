<?php

namespace App\Classes;

class Filters
{
    public function filter($value, $type)
    {
        switch ($type) {
            case 'string':
                return filter_var($_POST[$value], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
                break;

            case 'int':
                return filter_var($_POST[$value], FILTER_SANITIZE_NUMBER_INT);
                break;

            case 'email':
                return filter_var($_POST[$value], FILTER_SANITIZE_EMAIL);
                break;
        }
    }
}
