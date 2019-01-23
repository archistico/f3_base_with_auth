<?php
namespace App;

class Todo
{
    public function beforeroute($f3)
    {
        \App\Auth::PageCheckAuth($f3);
    }

    public $id;
    public $todo;

    public function __construct($id, $todo)
    {
        $this->id = $id;
        $this->todo = $todo;
    }

    public function ToArray()
    {
        return ['id' => $this->id, 'todo' => $this->todo];
    }

    public function Delete($f3, $params)
    {
        $db = new \DB\SQL($f3->get('DB_APP'));

        $id = $params['id'];
        $sql = "DELETE FROM todos WHERE id=$id";

        $db->begin();
        $db->exec($sql);
        $db->commit();

        // ridirigi
        $f3->reroute('/');
    }

    public function Add($f3)
    {
        $todo = $f3->get('POST.todo');

        $todo = \App\Utility::CleanString($todo);

        if (isset($todo)) {
            $db = new \DB\SQL($f3->get('DB_APP'));
            $db->begin();
            $sql = "INSERT into todos values(null, '$todo')";
            $db->exec($sql);
            $db->commit();
        }

        // ridirigi
        $f3->reroute('/');
    }
}
