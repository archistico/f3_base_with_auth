<?php
namespace App;

class Homepage
{
    public function beforeroute($f3)
    {
        $auth = \App\Auth::Auth($f3);
        if (!$auth) {
            \App\Flash::instance()->addMessage('Login required', 'danger');
            $f3->set('logged', false);
            $f3->reroute('/login');
        } else {
            $f3->set('logged', true);
        }
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
