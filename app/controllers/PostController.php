<?php

require_once PROJECT_ROOT . '/app/controllers/AjaxController.php';

/**
 * the controller that handles the posts
 */
class PostController extends AjaxController
{
    
    /**
     * the action that creates the posts via AJAX
     */
    public function createAction()
    {
        header('Content-type: application/json');

        try {
            $userId = $_SESSION['user_id'];

            $user = UserTable::load($userId);

            $post = new Post();
            $post->user_id = $userId;
            $post->text = $this->getPostParameter('text');
            $post->save();

            $response = array(
                'message' => 'post created successfully!',
                'success' => true,
                'author' => $user->name,
                'date' => $post->created_at,
                'post_id' => $post->id
            );
        } catch (Exception $e) {
            $response = array(
                'message' => 'could not create post',
                'success' => false
            );

            Dweet_Logger::log('error', $e->getMessage());
        }

        echo json_encode($response);
    }

}

