<?php

require_once PROJECT_ROOT . '/app/models/BaseModel.php';

/**
 * the comment model
 */
class Comment extends BaseModel
{
   
    public $created_at;
    public $post_id;
    public $text;
    public $user_id;

    protected $post = null;
    protected $user = null;

    /**
     * saves the model.
     * decides to insert if the model is new, or update if the model is "dirty"
     * 
     */
    public function save()
    {
        empty($this->id) ? $this->create() : $this->update();
    }

    /**
     * implements the mysql insert query with a PDO prepared statement
     */
    protected function create()
    {
        $this->created_at = date('Y-m-d H:i:s');

        $stmt = $this->db->prepare('INSERT INTO comment (user_id, post_id, text, created_at) VALUES (:user_id, :post_id, :text, :created_at)');
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->execute();

        $this->id = $this->db->lastInsertId();
    }

    /**
     * implements the mysql update query with a PDO prepared statement
     */
    protected function update()
    {
        $stmt = $this->db->prepare('UPDATE comment SET text = :text WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':text', $this->text);
        $stmt->execute();
    }

    /**
     * implements the mysql delete query with a PDO prepared statement
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM comment WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * loads the Post model of this comment
     * 
     * @return Post 
     */
    public function getPost()
    {
        if ($this->post === null) {
            $this->post = PostTable::load($this->post_id);
        }

        return $this->post;
    }

    /**
     * loads the User model of this comment
     * 
     * @return User
     */
    public function getUser()
    {
        if ($this->user === null) {
            $this->user = UserTable::load($this->user_id);
        }

        return $this->user;
    }

}
