<?php

session_start();

$root_path = $_SERVER['DOCUMENT_ROOT'] . "/mindmed";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once $root_path . "/config/database.php";
require_once $root_path . "/includes/layout.php";
require_once $root_path . "/posts/post.php";
require_once $root_path . "/posts/PostController.php";

$controller = new PostController($conn);
$data = $controller->handleCreateRequest();

$message = $data["message"];
$selected_category = $data["selected_category"];

renderHead("Create Post | MindMend");
renderHeader("../");

?>

<div class="form-page">
<div class="form-card">

    <h1>Share a thought</h1>
    <p class="subtitle">
        Express what is on your mind.
    </p>

    <?php if ($message != ""): ?>
        <div class="alert alert-error">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>Title</label>
            <input
            type="text"
            name="title"
            placeholder="Give your post a title"
            value="<?php echo htmlspecialchars($_POST["title"] ?? ""); ?>"
            required>
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category">
                <option value="Anxiety" <?php echo ($selected_category === 'Anxiety') ? 'selected' : ''; ?>>
                    Anxiety
                </option>
                <option value="Stress" <?php echo ($selected_category === 'Stress') ? 'selected' : ''; ?>>
                    Stress
                </option>
                <option value="Burnout" <?php echo ($selected_category === 'Burnout') ? 'selected' : ''; ?>>
                    Burnout
                </option>
                <option value="Academic Pressure" <?php echo ($selected_category === 'Academic Pressure') ? 'selected' : ''; ?>>
                    Academic Pressure
                </option>
                <option value="Loneliness" <?php echo ($selected_category === 'Loneliness') ? 'selected' : ''; ?>>
                    Loneliness
                </option>
                <option value="Other" <?php echo ($selected_category === 'Other') ? 'selected' : ''; ?>>
                    Other
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Your thoughts</label>
            <textarea
            name="content"
            rows="8"
            placeholder="Write what you want to share..."
            required><?php echo htmlspecialchars($_POST["content"] ?? ""); ?></textarea>
        </div>

        <div class="form-group">
            <label style="
            display:flex;
            align-items:center;
            gap:8px;
            font-weight:normal;
            ">
                <input
                type="checkbox"
                name="is_anonymous"
                <?php echo (!isset($_POST['is_anonymous']) && $_SERVER['REQUEST_METHOD'] === 'POST') ? '' : 'checked'; ?>
                style="width:auto;">

                Post anonymously
            </label>
        </div>

        <button type="submit" class="btn">
            Publish Post
        </button>

    </form>

    <a
    href="../dashboard.php"
    style="
    display:block;
    text-align:center;
    margin-top:20px;
    color:#74817c;
    text-decoration:none;
    font-size:14px;
    ">
        ← Back to Community
    </a>

</div>
</div>

<?php
renderFooter();
?>