<?php

namespace App\Model\DAO;

use App\Model\DTO\DeviceDTO;
use Model\Db;

class DeviceDAO{
    protected $pdo;
    const TABLE_NAME = 'devices';

    public function __construct()
    {
        $this->pdo = Db::getPDOInstance();
    }

    /**
     * @return array
     * of DeviceDTO objects
     */
    public function getAll():array
    {
        $query = "SELECT * FROM ".self::TABLE_NAME;
        $queryResult = $this->pdo->query($query);
        $result = [];
        $rows = $queryResult ? $queryResult->fetchAll() : [];
        foreach($rows as $row){
            $dto = new DeviceDTO($row['id'], $row['name'], $row['is_working'], json_decode($row['settings'], true));
            $result[] = $dto;
        }
        return $result;
    }
    public function find(int $id):DeviceDTO{
        $query = "SELECT * from ".self::TABLE_NAME." where id={$id}";
        $result = $this->pdo->query($query);
        $row = $result->fetch();
        return new DeviceDTO($row['id'], $row['name'], $row['is_working'], json_decode($row['settings'], true));
    }

    public function create(DeviceDTO $device):bool{
        $query = "INSERT INTO ".self::TABLE_NAME."(name, is_working, settings) VALUES(':name', :is_working, ':settings')";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':name' => $device->getName(),
            ':is_working' => $device->getIsWorking(),
            ':settings' => $device->getSettingsJson()
        ]);
    }

    public function update(DeviceDTO $device):bool{
        $query = "UPDATE ".self::TABLE_NAME." SET name=':name', is_working=:is_working, settings=':settings') where id=:id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':id' => $device->getId(),
            ':name' => $device->getName(),
            ':is_working' => $device->getIsWorking(),
            ':settings' => $device->getSettingsJson()
        ]);
    }

    public function delete(int $id){
        $query = "DELETE FROM ".self::TABLE_NAME." where id=:id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
