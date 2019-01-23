<?php
namespace App;

class Homepage extends Controller
{
    public function beforeroute($f3)
    {
        \App\Auth::PageCheckAuth($f3);
    }

    public function Show($f3)
    {
        $sql = 'SELECT * FROM todos';
        $todos = $this->db->exec($sql);

        $f3->set('todos', $todos);

        $f3->set('title', 'Homepage');
        $f3->set('container', 'homepage.htm');
        echo \Template::instance()->render('templates/base.htm');
    }

}
