<?php
/**
 * Created by PhpStorm.
 * User: AS-LS
 * Date: 28.05.14
 * Time: 12:19
 */
namespace AdvancedStore\ApiClient\Facades;

use Illuminate\Support\Facades\Facade;


class ApiClientFacade extends Facade{
    protected static function getFacadeAccessor() { return 'apiClient'; }
}