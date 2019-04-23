<?php
/**
 * Created by PhpStorm.
 * User: bilal
 */

if (! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * Generates UUID and append it to prefix provided
 */
if(! function_exists('getUniqueKey')){
    function getUniqueKey($prefix){

        $UUID = uniqid();
        $UUID = $prefix.strtoupper($UUID);
        $UniqueKey = $UUID;

        return $UniqueKey;
    }
}

/*
 *
 * Generates random number between 0.0 to 10.0
 */
if (! function_exists('generateRandomStat')) {
    function generateRandomStat(){

        $min = 0;
        $max = 10;

        $randomStat = mt_rand($min*10, $max*10)/10;
        $randomStat = round($randomStat, 2);
        return $randomStat;
    }
}

/*
 *
 * Sorts list of horses with respect to distance covered is time
 */
if (! function_exists('compareDistanceAndTime')) {
    function compareDistanceAndTime($a, $b) {

        if($a[CN_DISTANCE_COVERED] == $b[CN_DISTANCE_COVERED]){

            if ($a[CN_TIME_DURATION] == $b[CN_TIME_DURATION]) {
                return 0;
            }
            return ($a[CN_TIME_DURATION] < $b[CN_TIME_DURATION]) ? -1 : 1;
        }
        else{
            return ($a[CN_DISTANCE_COVERED] > $b[CN_DISTANCE_COVERED]) ? -1 : 1;
        }
    }
}
