<?php
//$pacth="/var/www/laravel2/public/";
$pacth="";
$root="test.safe-bag.com";
/* Admin User Designations */
return [

    'userDesignations'      =>  array(
        '1' => 'Administrator',
        '2' => 'Marketing',
        '3' => 'Management',
        '4' => 'CustomerCare'),

    'apLanguages'           =>  array(  'en' => 'English',
        'it' => 'Italy',
        'fr' => 'French'),

    'adminUserFotoPath'     =>  $pacth.'adminpictures/',

    //'adminAPImagePath'      =>  '/var/www/html/safe-bag/cmproducts/images/',
    'adminAPImagePath'      =>  $pacth.'airproductpictures/',


    'scLanguages'           =>  array(  'en' => 'English',
        'fr' => 'French',
        'it' => 'Italy'),

    'acDays'                =>  array(  'lun'=> 'Monday',
        'mar'=> 'Tuesday',
        'mer'=> 'Wednesday',
        'gio'=> 'Thursday',
        'ven'=> 'Friday',
        'sab'=> 'Saturday',
        'dom'=> 'Sunday'),

];


