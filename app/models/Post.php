<?php

require_once PROJECT_ROOT . '/app/models/BaseModel.php';

/**
 * the post model
 */
class Post extends BaseModel
{
    
    public $created_at;
    public $text;
    public $user_id;

    protected $comments = null;
    protected $user     = null;

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

        $stmt = $this->db->prepare('INSERT INTO post (user_id, text, created_at) VALUES (:user_id, :text, :created_at)');
        $stmt->bindParam(':user_id', $this->user_id);
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
        $stmt = $this->db->prepare('UPDATE post SET text = :text WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':text', $this->text);
        $stmt->execute();
    }

    /**
     * implements the mysql delete query with a PDO prepared statement
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM post WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * returns an array containing this post's comments
     * 
     * @return array an array of Comment models
     */
    public function getComments()
    {
        if ($this->comments === null) {
            $this->comments = CommentTable::listAll($this->user_id, $this->id);
        }

        return $this->comments;
    }
     
    /**
     * loads this comment's User model
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
