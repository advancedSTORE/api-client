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

    public function setApiResponse( $apiResponse ){
        $this->apiResponse = $apiResponse;
    }

    public function getUserPermissions(){
//        $this->userPermissions = ['ad4mat.admin.dashboard','ad4mat.admin.users.read'];

        $this->userPermissions = $this->extractUserPermissions();

        return $this->userPermissions;
    }

    /**
     * @return array
     * Extract and merge all user permissions from user roles(groups) and partner roles
     * into a single array with unique values.
     */
    private function extractUserPermissions( ){
        $groupPermissions = $this->getAppPermissions( $this->apiResponse->groups );
        $partnerPermissions = $this->getAppPermissions( $this->apiResponse->partnerRoles );

        $userPermissions = array_merge( $groupPermissions, $partnerPermissions );

        return array_unique( $userPermissions );
    }


    private function getAppPermissions( $userRoles ){

        $permissionArray = [];

        foreach( $userRoles as $role ){
            foreach( $role->appPermissions->toArray() as $appPermission ){
                $permissionArray[] = $appPermission['appPermissionName'];
            }
        }

        return $permissionArray;
    }

}