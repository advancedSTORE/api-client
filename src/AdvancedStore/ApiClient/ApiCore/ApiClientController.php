<?php
/**
 * Created by PhpStorm.
 * User: AS-LS
 * Date: 28.05.14
 * Time: 12:26
 */

namespace AdvancedStore\ApiClient\ApiCore;

class ApiClientController{

    private $apiResponse = null;

    private static $O_AUTH_2_CLIENT = null;
    private static $API_PATH = null;

    public function __construct(){

    }

    public function setApiResponse( $apiResponse ){
        $this->apiResponse = $apiResponse;
    }

    public function getUserPermissions()
    {
        if(self::$O_AUTH_2_CLIENT == null){
            self::$O_AUTH_2_CLIENT = \O2Client::getFacadeRoot();
        }
        if(self::$API_PATH == null){
            self::$API_PATH =   \Request::root() . \Config::get('apiClientConfig.ApiPath');
        }
        $this->setApiResponse(self::$O_AUTH_2_CLIENT->fetch(self::$API_PATH));

        if (self::$O_AUTH_2_CLIENT->hasValidAccessToken()) {
            return $this->extractUserPermissions();
        }

        return [];
    }

    /**
     * @return array
     * Extract and merge all user permissions from user roles(groups) and partner roles
     * into a single array with unique values.
     */
    private function extractUserPermissions( ){

        $groupPermissions = $partnerPermissions = [];
        if( isset( $this->apiResponse['result']['groups'] ) ) {
            $groupPermissions = $this->getAppPermissions($this->apiResponse['result']['groups']);
        }
        if( isset( $this->apiResponse['result']['partner_roles'] ) ){
            $partnerPermissions = $this->getAppPermissions( $this->apiResponse['result']['partner_roles'] );
        }
        $userPermissions = array_merge( $groupPermissions, $partnerPermissions );

        return array_unique( $userPermissions );
    }


    private function getAppPermissions( $userRoles ){
        $permissionArray = [];
        foreach( $userRoles as $role ){
            foreach( $role['app_permissions'] as $appPermission ){
                $permissionArray[] = $appPermission['app_permission_name'];
            }
        }

        return $permissionArray;
    }

}