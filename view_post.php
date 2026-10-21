<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: auth/login.php");
    exit();

}

include "config/database.php";
require_once __DIR__ . '/includes/layout.php';

if (!isset($_GET["id"])) {

    header("Location: dashboard.php");
    exit();

}

$post_id = intval($_GET["id"]);
$user_id = $_SESSION["user_id"];

// Handle Comment Deletion
if (isset($_GET["delete_comment"])) {
    $comment_id = intval($_GET["delete_comment"]);
    $del_sql = $conn->prepare("DELETE FROM comments WHERE comment_id = ? AND user_id = ?");
    $del_sql->execute([$comment_id, $user_id]);
    header("Location: view_post.php?id=" . $post_id);
    exit();
}

// Handle Comment Editing (POST submission for edit)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit_comment_id"])) {
    $comment_id = intval($_POST["edit_comment_id"]);
    $new_text = trim($_POST["edit_comment_text"]);
    if (!empty($new_text)) {
        $up_sql = $conn->prepare("UPDATE comments SET comment_text = ? WHERE comment_id = ? AND user_id = ?");
        $up_sql->execute([$new_text, $comment_id, $user_id]);
    }
    header("Location: view_post.php?id=" . $post_id);
    exit();
}

// Handle New Comment Creation
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comment_text"]) && !isset($_POST["edit_comment_id"])) {
    $comment = trim($_POST["comment_text"]);

    if (!empty($comment)) {
        $comment_sql = $conn->prepare(
            "INSERT INTO comments
            (post_id, user_id, comment_text)
            VALUES (?, ?, ?)"
        );

        $comment_sql->execute([
            $post_id,
            $user_id,
            $comment
        ]);

        header("Location: view_post.php?id=" . $post_id);
        exit();
    }
}

$post_sql = $conn->prepare(
    "SELECT posts.*, users.pseudo_name
     FROM posts
     INNER JOIN users
     ON posts.user_id = users.user_id
     WHERE posts.post_id = ?"
);

$post_sql->execute([$post_id]);

$post = $post_sql->fetch(PDO::FETCH_ASSOC);

if (!$post) {

    die("Post not found.");

}

$comments_sql =
    $conn->prepare(
        "SELECT comments.*,
                users.pseudo_name
         FROM comments
         INNER JOIN users
         ON comments.user_id =
            users.user_id
         WHERE comments.post_id = ?
         ORDER BY comments.timestamp ASC"
    );

$comments_sql->execute([$post_id]);

$comments = $comments_sql->fetchAll(PDO::FETCH_ASSOC);

renderHead("View Post | MindMend");
renderHeader("");

?>

<div class="container page">

    <div style="margin-bottom: 20px;">
        <a href="dashboard.php" style="color: var(--muted); text-decoration: none; font-size: 14px; font-weight: bold;">
            ← Back to Community
        </a>
    </div>

    <!-- MAIN POST CARD -->
    <div class="card" style="margin-bottom: 30px;">
        
        <div class="post-top">
            <div class="user">
                <div class="avatar">
                    <?php 
                    echo $post["is_anonymous"] ? "?" : strtoupper(substr($post["pseudo_name"], 0, 1)); 
                    ?>
                </div>
                <div>
                    <strong>
                        <?php
                        echo $post["is_anonymous"]
                            ? "Anonymous Student"
                            : htmlspecialchars($post["pseudo_name"]);
                        ?>
                    </strong>
                    <div style="font-size: 12px; color: var(--muted);">
                        <?php echo htmlspecialchars($post["created_at"] ?? ""); ?>
                    </div>
                </div>
            </div>

            <?php if (!empty($post["category"])): ?>
                <span class="category">
                    #<?php echo htmlspecialchars($post["category"]); ?>
                </span>
            <?php endif; ?>
        </div>

        <?php if (!empty($post["title"])): ?>
            <h2 style="color: var(--primary-dark); margin-bottom: 15px; font-size: 22px;">
                <?php echo htmlspecialchars($post["title"]); ?>
            </h2>
        <?php endif; ?>

        <div class="post-content" style="font-size: 15px; line-height: 1.7; color: var(--text);">
            <?php
            echo nl2br(
                htmlspecialchars(
                    $post["content"]
                )
            );
            ?>
        </div>

    </div>

    <!-- COMMENTS SECTION -->
    <div class="card">
        
        <h3 style="color: var(--primary-dark); margin-bottom: 20px; font-size: 18px;">
            Supportive Comments (<?php echo count($comments); ?>)
        </h3>

        <form method="POST" style="margin-bottom: 30px;">
            <div class="form-group">
                <textarea
                    name="comment_text"
                    rows="4"
                    placeholder="Write a supportive comment..."
                    required
                ></textarea>
            </div>
            <button type="submit" class="btn">
                Send Comment
            </button>
        </form>

        <div class="comments-list">
            <?php if (empty($comments)): ?>
                <p style="color: var(--muted); font-size: 14px; font-style: italic;">
                    No comments yet. Be the first to offer support!
                </p>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment" style="padding: 16px 0; border-bottom: 1px solid var(--border);">
                        
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="comment-name">
                                <?php echo htmlspecialchars($comment["pseudo_name"]); ?>
                            </div>

                            <!-- Show Edit/Delete buttons if the logged-in user owns the comment -->
                            <?php if ($comment["user_id"] == $user_id): ?>
                                <div style="display: flex; gap: 10px; font-size: 13px;">
                                    <a href="#" onclick="toggleEditForm(<?php echo $comment['comment_id']; ?>); return false;" style="color: #5578a5; text-decoration: none;">Edit</a>
                                    <a href="view_post.php?id=<?php echo $post_id; ?>&delete_comment=<?php echo $comment['comment_id']; ?>" onclick="return confirm('Are you sure you want to delete this comment?');" style="color: var(--danger); text-decoration: none;">Delete</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Normal Comment Display -->
                        <div id="comment-text-<?php echo $comment['comment_id']; ?>" class="comment-text" style="margin-top: 5px;">
                            <?php
                            echo nl2br(
                                htmlspecialchars(
                                    $comment["comment_text"]
                                )
                            );
                            ?>
                        </div>

                        <!-- Hidden Edit Form for this comment -->
                        <?php if ($comment["user_id"] == $user_id): ?>
                            <form id="edit-form-<?php echo $comment['comment_id']; ?>" method="POST" style="display: none; margin-top: 10px;">
                                <input type="hidden" name="edit_comment_id" value="<?php echo $comment['comment_id']; ?>">
                                <div class="form-group" style="margin-bottom: 8px;">
                                    <textarea name="edit_comment_text" rows="2" required><?php echo htmlspecialchars($comment['comment_text']); ?></textarea>
                                </div>
                                <button type="submit" class="btn" style="padding: 6px 12px; font-size: 12px;">Save</button>
                                <button type="button" class="btn btn-light" onclick="toggleEditForm(<?php echo $comment['comment_id']; ?>)" style="padding: 6px 12px; font-size: 12px;">Cancel</button>
                            </form>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

</div>

<script>
function toggleEditForm(id) {
    var textDiv = document.getElementById('comment-text-' + id);
    var formDiv = document.getElementById('edit-form-' + id);
    if (formDiv.style.display === 'none') {
        formDiv.style.display = 'block';
        textDiv.style.display = 'none';
    } else {
        formDiv.style.display = 'none';
        textDiv.style.display = 'block';
    }
}
</script>

<?php
renderFooter();
?>