<?php

require_once PROJECT_ROOT . '/app/models/BaseModelTable.php';

class PostTable extends BaseModelTable
{

    static public function load($id)
    {
        $stmt = Dweet::getInstance()->db->prepare('SELECT id, user_id, text, created_at FROM post WHERE id = ? LIMIT 0, 1');

        if ($stmt->execute(array($id))) {
            $post = null;

            while($row = $stmt->fetch()) {
                $post = new Post($id);
                $post->user_id    = $row['user_id'];
                $post->text       = $row['text'];
                $post->created_at = $row['created_at'];
            }

            return $post;
        }

        return null;
    }

    static public function listAll($userId = null)
    {
        $query = 'SELECT id, user_id, text, created_at FROM post';

        if ($userId) {
            $query .= ' WHERE user_id = ?';
        }

        $query .= ' ORDER BY created_at DESC';

        $stmt = Dweet::getInstance()->db->prepare($query);
        if ($userId ? $stmt->execute(array($userId)) : $stmt->execute()) {
           
            $posts = array();

            while ($row = $stmt->fetch()) {
                $post = new Post($row['id']);
                $post->user_id    = $row['user_id'];
                $post->text       = $row['text'];
                $post->created_at = $row['created_at'];

                $posts[] = $post;
            }
            
            return $posts;
        }

        return array();
    }

}
