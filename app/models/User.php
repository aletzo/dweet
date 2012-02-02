<?php

require_once PROJECT_ROOT . '/app/models/BaseModel.php';

/**
 * the user model
 */
class User extends BaseModel
{
    public $name;

    protected $comments;
    protected $posts;

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
        $stmt = $this->db->prepare('INSERT INTO user (name) VALUES (:name)');
        $stmt->bindParam(':name', $this->name);
        $stmt->execute();

        $this->id = $this->db->lastInsertId('id');
    }
    
    /**
     * implements the mysql update query with a PDO prepared statement
     */
    protected function update()
    {
        $stmt = $this->db->prepare('UPDATE user SET name = :name WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->execute();
    }

    /**
     * implements the mysql delete query with a PDO prepared statement
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM user WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * returns an array containing this user's comments
     * 
     * @return array an array of Comment models
     */
    public function getComments()
    {
        if ($this->comments === null) {
            $this->comments = CommentTable::listAll($this->id);
        }

        return $this->comments;
    }

    /**
     * returns an array containing this user's posts
     * 
     * @return array an array of Post models
     */
    public function getPosts()
    {
        if ($this->posts === null) {
            $this->posts = PostTable::listAll($this->id);
        }

        return $this->posts;
    }

}
