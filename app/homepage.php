<?php
namespace App;

class Homepage
{
    public function beforeroute($f3)
    {
        \App\Auth::PageCheckAuth($f3);
    }

    public function Show($f3)
    {
        $db = new \DB\SQL($f3->get('DB_APP'));
        $sql = 'SELECT * FROM todos';
        $todos = $db->exec($sql);

        $f3->set('todos', $todos);

        $f3->set('title', 'Homepage');
        $f3->set('container', 'homepage.htm');
        echo \Template::instance()->render('templates/base.htm');
    }

}
