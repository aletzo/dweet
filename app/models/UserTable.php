<?php

require_once PROJECT_ROOT . '/app/models/BaseModelTable.php';

class UserTable extends BaseModelTable
{

    static public function load($id)
    {
        $stmt = Dweet::getInstance()->db->prepare('SELECT id, name FROM user WHERE id = ? LIMIT 0, 1');

        if ($stmt->execute(array($id))) {
            $user = null;

            while($row = $stmt->fetch()) {
                $user = new User($id);
                $user->name = $row['name'];
            }

            return $user;
        }

        return null;
    }

    static public function listall()
    {
        $stmt = Dweet::getInstance()->db->prepare('SELECT id, name FROM user');

        if ($stmt->execute()) {
           
            $users = array();

            while ($row = $stmt->fetch()) {
                $user = new User($row['id']);
                $user->setName($row['name']);

                $users[] = $user;
            }
            
            return $users;
        }

        return array();
    }

}
