<?php
namespace App;

class Todos
{
    public $todos;

    public function __construct()
    {
        $this->todos = [];
    }

    public function Add($todo)
    {
        $this->todos[] = $todo;
    }

    public function ToArray()
    {
        $ret = [];
        foreach ($this->todos as $todo) {
            $ret[] = $todo->ToArray();
        }
        return $ret;
    }

    public function GetList()
    {
        return $this->todos;
    }
}
