<?php

namespace App\Services;
use App\Model\DAO\DeviceDAO;
use App\Model\DTO\DeviceDTO;

class ApiService{
    
    public function __construct()
    {
        $this->deviceDAO = new DeviceDAO();
    }

    public function getDevices(){
        $devices =  $this->deviceDAO->getAll();
        return json_encode($devices);
    }

    public function createDevice(array $request){
        if(array_key_exists('action', $request))
            unset($request['action']);
        $name = $_REQUEST['name'];unset($_REQUEST['name']);
        $isWorking = $_REQUEST['is_working'];unset($_REQUEST['is_working']);
        $settings = $_REQUEST;
        $device = new DeviceDTO(null, $name, $isWorking, $settings);
        $result = $this->deviceDAO->create($device);
        $response = null;
        if($result)
            $response = json_encode(['message' => 'Urządzenie zostało dodane']);
        else
            $response = json_encode(['error' => true, 'message' => 'Nie udało się dodać urządzenia']);
        return $response;
    }

    public function updateDevice(array $request){
        if(array_key_exists('action', $request))
            unset($request['action']);
        $id = $request['id'];unset($request['id']);
        $name = $request['name'];unset($request['name']);
        $isWorking = $request['is_working'];unset($request['is_working']);
        $settings = $request;
        $device = $this->deviceDAO->find($id);
        $device->setName($name);
        $device->setIsWorking($isWorking);
        $device->setSettings($settings);
        $result = $this->deviceDAO->update($device);
        $response = null;
        if($result)
            $response = json_encode(['message' => 'Urządzenie zostało zmienione']);
        else
            $response = json_encode(['error' => true, 'message' => 'Nie udało się zmienić urządzenia']);
        return $response;
    }

    public function deleteDevice(array $request){
        $id = $request['id'];
        $result = $this->deviceDAO->delete($id);
        $response = null;
        if($result)
            $response = json_encode(['message' => 'Urządzenie zostało usunięte']);
        else
            $response = json_encode(['error' => true, 'message' => 'Nie udało się usunąć urządzenia']);
        return $response;
    }
}