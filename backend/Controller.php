<?php
    namespace App;

use App\Model\DAO\DeviceDAO;
use App\Model\DTO\DeviceDTO;
use Model\Db;

class Controller {
        
    const ACTION_GET_DEVICES = 0;
    const ACTION_ADD_NEW_DEVICE = 1;
    const ACTION_EDIT_DEVICE_SETTINGS = 2;
    const ACTION_DELETE_DEVICE = 3;

    public function __construct()
    {
        $this->deviceDAO = new DeviceDAO(Db::getPDOInstance());
    }
    public function process(){
        $action = $_REQUEST['action'] ?? self::ACTION_GET_DEVICES;
        unset($_REQUEST['action']);
        switch($action){
            case self::ACTION_GET_DEVICES:
                $devices =  $this->deviceDAO->getAll();
                header('content-type: application/json');
                echo json_encode($devices);
                break;
            case self::ACTION_ADD_NEW_DEVICE:
                $name = $_REQUEST['name'];unset($_REQUEST['name']);
                $isWorking = $_REQUEST['is_working'];unset($_REQUEST['is_working']);
                $settings = $_REQUEST;
                $device = new DeviceDTO(null, $name, $isWorking, $settings);
                $result = $this->deviceDAO->create($device);
                header('content-type: application/json');
                if($result)
                    echo json_encode(['message' => 'Urządzenie zostało dodane']);
                else
                    echo json_encode(['error' => true, 'message' => 'Nie udało się dodać urządzenia']);
                break;
        }
    }
}
