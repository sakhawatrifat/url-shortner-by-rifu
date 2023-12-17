<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Http\Client\Exception\RequestException;
use Illuminate\Support\Facades\Http;


//Get Base Url
if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = '//' . $_SERVER['HTTP_HOST'];
        $root = $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}

//Make Random Digit
if (!function_exists('generateRandomNumber')) {
    function generateRandomNumber($digitLength)
    {
        $digit = $digitLength;
        $randomNumber = rand(pow(10, $digit-1), pow(10, $digit)-1);

        return $randomNumber;
    }
}