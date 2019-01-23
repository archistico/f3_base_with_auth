<?php
namespace App;

class Admin
{
    public function beforeroute($f3)
    {
        \App\Auth::PageCheckAuth($f3);
    }

    public function User_new($f3, $args)
    {
        $f3->set('title', 'User');
        $f3->set('container', '/user/user_new.htm');
        echo \Template::instance()->render('templates/base.htm');
    }

    public function User_list($f3, $args)
    {
        $db = new \DB\SQL($f3->get('DB_APP'));
        $sql = "SELECT user_id from users";

        $f3->set('list_users', $db->exec($sql));
        $f3->set('title', 'User');
        $f3->set('container', '/user/user_list.htm');
        echo \Template::instance()->render('templates/base.htm');
    }

    public function User_save($f3, $args)
    {
        if ($f3->VERB == 'POST') {
            // CARICA I DATI INVIATI E DI SESSIONE
            $username = $f3->get('POST.username');
            $username = str_replace(" ", "_", $username);
            $password_hash = $f3->get('POST.p');
            $db = new \DB\SQL($f3->get('DB_APP'));
            $db->begin();
            $sql = "INSERT INTO users VALUES('$username', '$password_hash')";
            $db->exec($sql);
            $db->commit();
            $f3->reroute('/user');
        }
    }

    public function User_delete($f3, $args)
    {
        $username = $f3->get('PARAMS.user_id');

        $db = new \DB\SQL($f3->get('DB_APP'));
        $db->begin();
        $sql = "DELETE FROM users WHERE users.user_id = '$username'";
        $db->exec($sql);
        $db->commit();
        \App\Flash::instance()->addMessage('User deleted', 'success');
        $f3->reroute('/user');
    }
}
