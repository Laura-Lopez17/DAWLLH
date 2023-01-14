<?php
class ProvinciaController
{
    private $connection;
    public static $KEY = "provincia";
    public static $KEY = "localidades";

    function construct($connection)
    {
        $this->connection = $connection;
    }
    function save($item)
    {
        $this->connection->hset(ProvinciaController::$KEY, $item->getId(), json_encode($item));
        $tempo = $this->connection->hget(
            ProvinciaController::$KEY,
            $item->getId()
        );
        if ($tempo != null)
            return true;
        else
            return false;
    }


    function remove($id)
    {

        $tempo = $this->connection->hdel(ProvinciaController::$KEY, $id);
        if ($tempo != null)
            return
                true;
        else
            return false;
    }

    function getAll()
    {
        $items = null;

        $elements = $this->connection->hgetAll(TipoController::$KEY);
        if ($elements != null) {
            $items = array();
            foreach ($elements as $json_text) {
                $tempo = new Tipo();
                $tempo->loadfromJSON($json_text);
                array_push(
                    $items,
                    $tempo
                );
            }
        }
        return $items;
    }

    function getById($id)
    {
        $item = null;
        $json_text = $this->connection->hget(
            TipoController::$KEY,
            $id
        );
        if ($json_text != null) {
            $item = new Tipo();
            $item->loadfromJSON($json_text);
        }
        return $item;
    }

    function getAllLocalidades()
    {
        $localidades = array();
        $elements = $this->connection->hgetAll(ProvinciaController::$KEY);
        if ($elements != null) {
            foreach ($elements as $json_text) {
                $localidad = new Localidad();
                $localidad->loadfromJSON($json_text);
                $localidades[] = $localidad;
            }
        }
        return $localidades;
    }

    function findLocalidad($name)
    {
        $json_text = $this->connection->hget(ProvinciaController::$KEY, $name);
        if ($json_text != null) {
            $localidad = new Localidad();
            $localidad->loadfromJSON($json_text);
            return $localidad;
        } else {
            return null;
        }
    }
}
