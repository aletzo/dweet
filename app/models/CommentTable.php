<?php

require_once PROJECT_ROOT . '/app/models/BaseModelTable.php';

class CommentTable extends BaseModelTable
{

    static public function load($id)
    {
        $stmt = Dweet::getInstance()->db->prepare('SELECT id, user_id, post_id, text, created_at FROM comment WHERE id = ? LIMIT 0, 1');

        if ($stmt->execute(array($id))) {
            $comment = null;

            while ($row = $stmt->fetch()) {
                $comment = new Comment($id);
                $comment->user_id    = $row['user_id'];
                $comment->post_id    = $row['post_id'];
                $comment->text       = $row['text'];
                $comment->created_at = $row['created_at'];
            }

            return $comment;
        }

        return null;
    }

    static public function listAll($userId = null, $postId = null)
    {
        $query = 'SELECT id, user_id, post_id, text, created_at FROM comment';

        $params = array();

        if ($userId) {
            $query .= ' WHERE user_id = ?'; 

            $params[] = $userId;
        }

        if ($postId) {
            $query .= $userId ? ' AND' : ' WHERE';
            $query .= ' post_id = ?';

            $params[] = $postId;
        }

        $query .= ' ORDER BY created_at DESC';

        $stmt = Dweet::getInstance()->db->prepare($query);

        if (count($params) ? $stmt->execute($params) : $stmt->execute()) {
           
            $comments = array();

            while ($row = $stmt->fetch()) {
                $comment = new Comment($row['id']);
                $comment->user_id    = $row['user_id'];
                $comment->post_id    = $row['post_id'];
                $comment->text       = $row['text'];
                $comment->created_at = $row['created_at'];

                $comments[] = $comment;
            }
            
            return $comments;
        }

        return array();
    }

}
