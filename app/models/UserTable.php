<?php

require_once PROJECT_ROOT . '/app/models/BaseModelTable.php';

/**
 * this class has all the select queries for the 'user' table
 */
class UserTable extends BaseModelTable
{

    /**
     * selects a single user from the database with a PDO prepared statement
     * 
     * @param integer $id the id of the user to load
     * @return mixed User if the user exists, null otherwise
     */
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

    /**
     * selects all the users from the database with a PDO prepared statement
     * 
     * @return array an array that contains the found users
     */
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
