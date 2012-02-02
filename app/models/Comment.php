<?php

require_once PROJECT_ROOT . '/app/models/BaseModel.php';

class Comment extends BaseModel
{

    public $created_at;
    public $post_id;
    public $text;
    public $user_id;

    protected $post = null;
    protected $user = null;

    public function save()
    {
        empty($this->id) ? $this->create() : $this->update();
    }

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

    protected function update()
    {
        $stmt = $this->db->prepare('UPDATE comment SET text = :text WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':text', $this->text);
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM comment WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getPost()
    {
        if ($this->post === null) {
            $this->post = PostTable::load($this->post_id);
        }

        return $this->post;
    }

    public function getUser()
    {
        if ($this->user === null) {
            $this->user = UserTable::load($this->user_id);
        }

        return $this->user;
    }

}
