<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: ../auth/login.php");
    exit();

}

include "../config/database.php";
require_once __DIR__ . '/../includes/layout.php';

if (!isset($_GET["id"])) {

    header("Location: ../dashboard.php");
    exit();

}

$post_id = intval($_GET["id"]);

$user_id = $_SESSION["user_id"];

$sql = $conn->prepare(
    "SELECT * FROM posts
     WHERE post_id = ?
     AND user_id = ?"
);

$sql->execute([
    $post_id,
    $user_id
]);

$post = $sql->fetch(PDO::FETCH_ASSOC);

if (!$post) {

    die("Post not found or access denied.");

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $content = trim($_POST["content"]);

    $category = $_POST["category"];

    $is_anonymous =
        isset($_POST["is_anonymous"])
        ? 1
        : 0;

    $update = $conn->prepare(
        "UPDATE posts
         SET
            content = ?,
            category = ?,
            is_anonymous = ?
         WHERE
            post_id = ?
            AND user_id = ?"
    );

    $update->execute([
        $content,
        $category,
        $is_anonymous,
        $post_id,
        $user_id
    ]);

    header("Location: ../dashboard.php");

    exit();

}

renderHead("MindMend | Edit Post");
renderHeader("../");

?>

<div class="form-page">
    <div class="form-card" style="max-width: 600px;">
        <h1>Edit Your Post</h1>
        <p class="subtitle">Modify your post details below.</p>

        <form method="POST">
            <div class="form-group">
                <label>Category</label>
                <input
                    type="text"
                    name="category"
                    value="<?php
                        echo htmlspecialchars(
                            $post["category"]
                        );
                    ?>"
                >
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea
                    name="content"
                    rows="8"
                    required
                ><?php
                    echo htmlspecialchars(
                        $post["content"]
                    );
                ?></textarea>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                <input
                    type="checkbox"
                    name="is_anonymous"
                    id="is_anonymous"
                    style="width: auto;"
                    <?php

                    if ($post["is_anonymous"]) {
                        echo "checked";
                    }

                    ?>
                >
                <label for="is_anonymous" style="margin-bottom: 0; cursor: pointer;">Post anonymously</label>
            </div>

            <button type="submit" class="btn" style="margin-top: 10px;">
                Update Post
            </button>
        </form>
    </div>
</div>

<?php
renderFooter();
?>