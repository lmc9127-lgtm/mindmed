<?php

class PostController {
    private $postModel;
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        $this->postModel = new Post($db);
    }

    public function handleCreateRequest() {
        $message = "";
        $selected_category = $_POST["category"] ?? "Other";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $title = trim($_POST["title"] ?? "");
            $content = trim($_POST["content"] ?? "");
            $category = $_POST["category"] ?? "Other";
            $is_anonymous = isset($_POST["is_anonymous"]) ? 1 : 0;

            if (empty($title) || empty($content)) {
                $message = "Please add a title and write something before posting.";
            } else {
                $newPostId = $this->postModel->addPost(
                    $_SESSION["user_id"],
                    $title,
                    $content,
                    $category,
                    $is_anonymous
                );

                if ($newPostId !== false) {
                    header("Location: ../dashboard.php");
                    exit();
                }

                $message = "Something went wrong while saving your post. Please try again.";
            }
        }

        return [
            "message" => $message,
            "selected_category" => $selected_category
        ];
    }
}

?>