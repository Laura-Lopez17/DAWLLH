<?php

class Provincia implements JsonSerializable
{
    protected $name;
    protected $id;
    protected $active;

    function construct()
    {
    }
    function loadfromJSON($json)
    {
        $tempo = json_decode($json, true);
        $this->id = $tempo["id"];
        $this->name = $tempo["name"];
        $this->active = $tempo["active"];
    }
    function getName()
    {
        return $this->name;
    }
    function getId()
    {
        return $this->id;
    }
    function getActive()
    {
        return $this->active;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function setId($id)
    {
        $this->id = $id;
    }
    function setActive($active)
    {
        $this->active = $active;
    }
    public function jsonSerialize()
    {
        return
            [
                'id' => $this->getId(),
                'name' => $this->getName(),
                'active' => $this->getActive()
            ];
    }
}
