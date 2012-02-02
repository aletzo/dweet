<?php

require_once PROJECT_ROOT . '/app/controllers/AjaxController.php';

/**
 * the controller to handle the comments
 */
class CommentController extends AjaxController
{

    /**
     * the action that creates the comment via AJAX
     */
    public function createAction()
    {
        header('Content-type: application/json');

        try {
            $userId = $_SESSION['user_id'];

            $user = UserTable::load($userId);

            $comment = new Comment();
            $comment->user_id = $userId;
            $comment->post_id = $this->getPostParameter('post_id');
            $comment->text = $this->getPostParameter('text');
            $comment->save();

            $response = array(
                'message' => 'comment created successfully!',
                'success' => true,
                'author' => $user->name,
                'date' => $comment->created_at,
                'post_id' => $comment->id
            );
        } catch (Exception $e) {
            $response = array(
                'message' => 'could not create comment',
                'success' => false
            );

            Dweet_Logger::log('error', $e->getMessage());
        }

        echo json_encode($response);
    }
    
}
