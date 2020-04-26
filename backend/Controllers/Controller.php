<?php

namespace App\Controllers;

use App\Services\ApiService;

class Controller {
        
    const ACTION_GET_DEVICES = 0;
    const ACTION_ADD_NEW_DEVICE = 1;
    const ACTION_EDIT_DEVICE_SETTINGS = 2;
    const ACTION_DELETE_DEVICE = 3;

    public function __construct()
    {
        $this->apiService = new ApiService();
    }
    public function processRequests(){
        $action = $_REQUEST['action'] ?? self::ACTION_GET_DEVICES;
        unset($_REQUEST['action']);
        header('content-type: application/json');
        switch($action){
            case self::ACTION_GET_DEVICES:
                echo $this->apiService->getDevices();
                break;
            case self::ACTION_ADD_NEW_DEVICE:
                echo $this->apiService->createDevice($_REQUEST);
                break;
            case self::ACTION_EDIT_DEVICE_SETTINGS:
                echo $this->apiService->updateDevice($_REQUEST);
                break;
            case self::ACTION_DELETE_DEVICE:
                echo $this->apiService->deleteDevice($_REQUEST);
                break;
        }
    }
}
