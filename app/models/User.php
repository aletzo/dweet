<?php

require_once PROJECT_ROOT . '/app/models/BaseModel.php';

class User extends BaseModel
{
    public $name;

    protected $comments;
    protected $posts;

    public function save()
    {
        empty($this->id) ? $this->create() : $this->update();
    }

    protected function create()
    {
        $stmt = $this->db->prepare('INSERT INTO user (name) VALUES (:name)');
        $stmt->bindParam(':name', $this->name);
        $stmt->execute();

        $this->id = $this->db->lastInsertId('id');
    }

    protected function update()
    {
        $stmt = $this->db->prepare('UPDATE user SET name = :name WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM user WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getComments()
    {
        if ($this->comments === null) {
            $this->comments = CommentTable::listAll($this->id);
        }

        return $this->comments;
    }

    public function getPosts()
    {
        if ($this->posts === null) {
            $this->posts = PostTable::listAll($this->id);
        }

        return $this->posts;
    }

}
