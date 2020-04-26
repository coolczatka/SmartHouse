<?php

namespace App\Model\DTO;

use JsonSerializable;

class DeviceDTO implements JsonSerializable{
    private $id;
    private $name;
    private $is_working;
    private $settings;

    public function __construct(?int $id, string $name, int $is_working, array $settings)
    {
        $this->id = $id;
        $this->name = $name;
        $this->is_working = $is_working;
        $this->settings = $settings;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function setName(string $name){
        $this->name = $name;
    }
    public function getIsWorking(){
        return $this->is_working;
    }
    public function setIsWorking(int $is_working){
        $this->is_working = $is_working;
    }
    public function getSettings(){
        return $this->settings;
    }
    public function setSettings(array $settings){
        $this->settings = $settings;
    }
    public function getSettingsJson(){
        return json_encode($this->settings);
    }
    public function setSettingsJson(string $settings){
        $this->settings = json_decode($settings, true);
    }
    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_working' => $this->is_working,
            'settings' => $this->settings
        ];
    }
}
