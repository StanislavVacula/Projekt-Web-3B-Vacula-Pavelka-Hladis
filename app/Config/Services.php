<?php

namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */

    public static function ionAuth($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('ionAuth');
        }

        return new \IonAuth\Libraries\IonAuth();
    }
}