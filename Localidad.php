<?php

class Localidad implements JsonSerializable, Provincia
{
    protected $name;
    protected $id;

    function construct()
    {
    }
    function loadfromJSON($json)
    {
        $tempo = json_decode($json, true);
        $this->id = $tempo["id"];
        $this->name = $tempo["name"];
    }
    function getName()
    {
        return $this->name;
    }
    function getId()
    {
        return $this->id;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function setId($id)
    {
        $this->id = $id;
    }
    public function jsonSerialize()
    {
        return
            [
                'id' => $this->getId(),
                'name' => $this->getName(),
            ];
    }
}
