<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/post.php";

$postModel = new Post($conn);

if (isset($_GET["id"])) {
    $post_id = intval($_GET["id"]);
    $user_id = $_SESSION["user_id"];
    $postModel->deletePost($post_id, $user_id);
}

header("Location: ../dashboard.php");
exit();

?>