<?php

class Post {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addPost($user_id, $title, $content, $category, $is_anonymous) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO posts (user_id, title, content, category, is_anonymous) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $title, $content, $category, $is_anonymous]);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getPosts() {
        try {
            $stmt = $this->conn->prepare("SELECT posts.*, users.pseudo_name FROM posts LEFT JOIN users ON posts.user_id = users.user_id ORDER BY post_id DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public function updatePost($post_id, $user_id, $title, $content, $category, $is_anonymous) {
        try {
            $stmt = $this->conn->prepare("UPDATE posts SET title = ?, content = ?, category = ?, is_anonymous = ? WHERE post_id = ? AND user_id = ?");
            return $stmt->execute([$title, $content, $category, $is_anonymous, $post_id, $user_id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deletePost($post_id, $user_id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM posts WHERE post_id = ? AND user_id = ?");
            return $stmt->execute([$post_id, $user_id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function searchPosts($keyword) {
        try {
            $searchTerm = "%" . $keyword . "%";
            $stmt = $this->conn->prepare("SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? OR category LIKE ? ORDER BY post_id DESC");
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}

?>