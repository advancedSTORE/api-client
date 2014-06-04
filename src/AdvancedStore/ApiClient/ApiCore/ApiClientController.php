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

    private $userPermissions = null;

    public function __construct(){

    }

    public function setApiResponse( $apiResponse ){
        $this->apiResponse = $apiResponse;
    }

    public function getUserPermissions(){

        $oauth2Client = \Config::get('api-client::apiClientConfig.OAuth2Client');



        $this->setApiResponse( $oauth2Client->fetch(\Config::get('api-client::apiClientConfig.ApiPath')) );


        $this->userPermissions = [];

        if( $oauth2Client->hasValidAccessToken() )
            $this->userPermissions = $this->extractUserPermissions();

        return $this->userPermissions;
    }

    /**
     * @return array
     * Extract and merge all user permissions from user roles(groups) and partner roles
     * into a single array with unique values.
     */
    private function extractUserPermissions( ){

        $groupPermissions = $this->getAppPermissions( $this->apiResponse['result']['groups'] );
        $partnerPermissions = $this->getAppPermissions( $this->apiResponse['result']['partner_roles'] );

        $userPermissions = array_merge( $groupPermissions, $partnerPermissions );

        return array_unique( $userPermissions );
    }


    private function getAppPermissions( $userRoles ){
        $permissionArray = [];
        foreach( $userRoles as $role ){
            foreach( $role['app_permissions'] as $appPermission ){
                $permissionArray[] = $appPermission['appPermissionName'];
            }
        }

        return $permissionArray;
    }

}