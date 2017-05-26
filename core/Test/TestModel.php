<?php


namespace core\Test;
use core\Container;
class TestModel
{
    protected  $db;
    public function test()
    {
        $this->db = Container::getMysql();
        $data = $this->db->from('user')->fetchAll();
        var_dump($data);



    }
}