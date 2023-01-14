<?php
class TipoController
{
    private $connection;
    public static $KEY = "tipo";
    function construct($connection)
    {
        $this->connection = $connection;
    }
    //guardar item, cierto si se ha podido insertar
    function save($item)
    {
        $this->connection->hset(TipoController::$KEY, $item->getId(), json_encode($item));
        $tempo = $this->connection->hget(
            TipoController::$KEY,
            $item->getId()
        );
        if ($tempo != null)
            return true;
        else
            return false;
    }
    //borra el elemento
    function remove($id)
    {

        $tempo = $this->connection->hdel(TipoController::$KEY, $id);
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
}
