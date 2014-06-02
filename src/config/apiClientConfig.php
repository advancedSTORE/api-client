<?php
/**
 * Created by PhpStorm.
 * User: AS-LS
 * Date: 28.05.14
 * Time: 18:02
 */


return [
    'OAuth2Client'      =>  O2Client::getFacadeRoot(),
    'ApiPath'           =>  Request::root() . '/api',
    'AccessTokenPath'           =>  Request::root() . '/api/access_token',
];