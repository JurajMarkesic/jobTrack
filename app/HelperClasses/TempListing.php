<?php
/**
 * Created by PhpStorm.
 * User: JURA
 * Date: 10.1.2018.
 * Time: 22:38
 */

namespace App\HelperClasses;

/**
 * Helper class to store listings that were received from outside sources but not yet saved
 *
 * Class TempListing
 * @package App\HelperClasses
 */

class TempListing
{
    public $title;
    public $company;
    public $location;
    public $link;

//    function __construct(String $title, String $company, String $location, String $link)
//    {
//        $this->$title = $title;
//        $this->$company = $company;
//        $this->$location = $location;
//        $this->$link = $link;
//    }
}