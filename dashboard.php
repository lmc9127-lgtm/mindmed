<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: auth/login.php");
    exit();
}

include "config/database.php";
require_once __DIR__ . '/includes/layout.php';

$sql = "
SELECT 
    posts.*, 
    users.pseudo_name, 
    COUNT(comments.comment_id) AS comment_count
FROM posts
INNER JOIN users 
    ON posts.user_id = users.user_id
LEFT JOIN comments 
    ON posts.post_id = comments.post_id
GROUP BY posts.post_id
ORDER BY posts.post_id DESC
";

$stmt = $conn->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

renderHead("MindMend | Community");
renderHeader();

?>

<style>
/* =========================================
   DASHBOARD DESIGN
========================================= */

.dashboard-wrapper {
    width: 92%;
    max-width: 1150px;
    margin: 35px auto 60px;
}

/* WELCOME */
.dashboard-welcome {
    background: linear-gradient(135deg, #52796f, #6f968b);
    border-radius: 20px;
    padding: 35px 40px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.welcome-text small {
    display: block;
    opacity: 0.8;
    margin-bottom: 8px;
    font-size: 14px;
}

.welcome-text h1 {
    font-size: 28px;
    margin-bottom: 8px;
}

.welcome-text p {
    opacity: 0.9;
    max-width: 550px;
}

.welcome-actions {
    margin-left: 20px;
}

.create-btn {
    display: inline-block;
    background: white;
    color: #354f52;
    text-decoration: none;
    padding: 13px 20px;
    border-radius: 10px;
    font-weight: bold;
    font-size: 14px;
    transition: 0.2s;
}

.create-btn:hover {
    transform: translateY(-2px);
}

/* MAIN GRID */
.community-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 280px;
    gap: 25px;
}

/* SEARCH & TOOLBAR */
.feed-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.feed-title h2 {
    color: #354f52;
    font-size: 23px;
    margin-bottom: 3px;
}

.feed-title p {
    color: #74817c;
    font-size: 14px;
}

.search-box {
    background: white;
    border: 1px solid #dfe7e3;
    border-radius: 10px;
    padding: 9px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-box input {
    border: none;
    outline: none;
    width: 180px;
    font-size: 13px;
    background: transparent;
}

/* POST */
.modern-post {
    background: white;
    border: 1px solid #e1e8e4;
    border-radius: 16px;
    padding: 22px;
    margin-bottom: 16px;
    transition: 0.2s;
}

.modern-post:hover {
    border-color: #b9cec6;
    box-shadow: 0 8px 25px rgba(50, 80, 70, 0.06);
}

/* POST HEADER */
.modern-post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.author {
    display: flex;
    align-items: center;
    gap: 10px;
}

.modern-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #e8f1ed;
    color: #52796f;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    font-size: 17px;
}

.author-info strong {
    display: block;
    color: #354f52;
    font-size: 14px;
}

.author-info span {
    color: #8a9691;
    font-size: 12px;
}

/* CATEGORY */
.post-category {
    display: inline-block;
    background: #eef5f1;
    color: #52796f;
    padding: 5px 11px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 12px;
}

/* CONTENT */
.modern-post-content {
    color: #4f5c57;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 18px;
}

/* POST FOOTER */
.modern-post-footer {
    border-top: 1px solid #edf1ef;
    padding-top: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.action-link {
    text-decoration: none;
    color: #71807a;
    font-size: 13px;
    padding: 7px 10px;
    border-radius: 7px;
    transition: 0.2s;
}

.action-link:hover {
    background: #eef5f1;
    color: #52796f;
}

.edit-link {
    color: #5278a0;
}

.delete-link {
    color: #c95d63;
}

.delete-link:hover {
    background: #fff0f1;
}

/* SIDEBAR */
.sidebar-card {
    background: white;
    border: 1px solid #e1e8e4;
    border-radius: 16px;
    padding: 22px;
    margin-bottom: 18px;
}

.sidebar-card h3 {
    color: #354f52;
    font-size: 16px;
    margin-bottom: 15px;
}

.sidebar-card p {
    color: #74817c;
    font-size: 13px;
    line-height: 1.6;
}

/* COMMUNITY RULES */
.community-rule {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 13px;
    color: #63706b;
}

.rule-number {
    width: 25px;
    height: 25px;
    min-width: 25px;
    border-radius: 50%;
    background: #e8f1ed;
    color: #52796f;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: bold;
}

/* EMPTY POST */
.empty-feed {
    background: white;
    border: 1px dashed #b7c9c1;
    border-radius: 16px;
    padding: 55px 20px;
    text-align: center;
}

.empty-icon {
    font-size: 40px;
    margin-bottom: 10px;
}

.empty-feed h3 {
    color: #354f52;
    margin-bottom: 8px;
}

.empty-feed p {
    color: #74817c;
    font-size: 14px;
    margin-bottom: 20px;
}

/* MOBILE */
@media (max-width: 850px) {
    .community-layout {
        grid-template-columns: 1fr;
    }
    .sidebar {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
}

@media (max-width: 650px) {
    .dashboard-wrapper {
        width: 94%;
        margin-top: 20px;
    }
    .dashboard-welcome {
        padding: 25px;
        display: block;
    }
    .welcome-actions {
        margin: 20px 0 0;
    }
    .feed-toolbar {
        align-items: flex-start;
        gap: 15px;
        flex-direction: column;
    }
    .search-box {
        width: 100%;
    }
    .search-box input {
        width: 100%;
    }
    .sidebar {
        grid-template-columns: 1fr;
    }
}
</style>

<main class="dashboard-wrapper">

    <!-- WELCOME SECTION -->
    <section class="dashboard-welcome">
        <div class="welcome-text">
            <small>YOUR SAFE SPACE</small>
            <h1>
                Welcome back,
                <?php echo htmlspecialchars($_SESSION["pseudo_name"]); ?>.
            </h1>
            <p>
                Take a moment to share what's on your mind
                or connect with the MindMend community.
            </p>
        </div>
        <div class="welcome-actions">
            <a href="posts/create_post.php" class="create-btn">
                + Add a Thought
            </a>
        </div>
    </section>

    <!-- COMMUNITY LAYOUT -->
    <div class="community-layout">

        <!-- MAIN FEED -->
        <section class="main-feed">

            <div class="feed-toolbar">
                <div class="feed-title">
                    <h2>Community Feed</h2>
                    <p>A space where every voice matters.</p>
                </div>
                <div class="search-box">
                    <span>🔍</span>
                    <input type="text" id="searchInput" placeholder="Search posts...">
                </div>
            </div>

            <!-- POSTS -->
            <?php if (!empty($posts)): ?>
                <div id="postsContainer">
                    <?php foreach ($posts as $post): ?>
                        <article class="modern-post" data-content="<?php echo htmlspecialchars(strtolower($post['content'] . ' ' . $post['pseudo_name'] . ' ' . $post['category'])); ?>">
                            
                            <!-- POST HEADER -->
                            <div class="modern-post-header">
                                <div class="author">
                                    <div class="modern-avatar">
                                        <?php
                                        if ($post["is_anonymous"]) {
                                            echo "?";
                                        } else {
                                            echo strtoupper(substr($post["pseudo_name"], 0, 1));
                                        }
                                        ?>
                                    </div>
                                    <div class="author-info">
                                        <strong>
                                            <?php
                                            if ($post["is_anonymous"]) {
                                                echo "Anonymous Student";
                                            } else {
                                                echo htmlspecialchars($post["pseudo_name"]);
                                            }
                                            ?>
                                        </strong>
                                        <span>
                                            <?php
                                            if (!empty($post["created_at"])) {
                                                echo date("M d, Y · h:i A", strtotime($post["created_at"]));
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- CATEGORY -->
                            <?php if (!empty($post["category"])): ?>
                                <div class="post-category">
                                    # <?php echo htmlspecialchars($post["category"]); ?>
                                </div>
                            <?php endif; ?>

                            <!-- POST CONTENT -->
                            <div class="modern-post-content">
                                <?php echo nl2br(htmlspecialchars($post["content"])); ?>
                            </div>

                            <!-- ACTIONS -->
                            <div class="modern-post-footer">
                                <a class="action-link" href="view_post.php?id=<?php echo $post["post_id"]; ?>">
                                    💬 <?php echo $post["comment_count"]; ?> Comments
                                </a>

                                <?php if ($post["user_id"] == $_SESSION["user_id"]): ?>
                                    <a class="action-link edit-link" href="posts/edit_post.php?id=<?php echo $post["post_id"]; ?>">
                                        ✏ Edit
                                    </a>
                                    <a class="action-link delete-link" href="posts/delete_post.php?id=<?php echo $post["post_id"]; ?>" onclick="return confirm('Are you sure you want to delete this post?');">
                                        Delete
                                    </a>
                                <?php endif; ?>
                            </div>

                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-feed">
                    <div class="empty-icon">🌱</div>
                    <h3>No posts yet</h3>
                    <p>The community is waiting for the first story to be shared.</p>
                    <a href="posts/create_post.php" class="create-btn">
                        Share Your First Thought
                    </a>
                </div>
            <?php endif; ?>

        </section>

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-card">
                <h3>Community Space</h3>
                <p>
                    MindMend is a space for students to
                    express thoughts and connect through
                    respectful peer support.
                </p>
            </div>

            <div class="sidebar-card">
                <h3>Community Guidelines</h3>
                <div class="community-rule">
                    <div class="rule-number">1</div>
                    <div>Be kind and respectful.</div>
                </div>
                <div class="community-rule">
                    <div class="rule-number">2</div>
                    <div>Respect everyone's privacy.</div>
                </div>
                <div class="community-rule">
                    <div class="rule-number">3</div>
                    <div>Offer support without judgment.</div>
                </div>
                <div class="community-rule">
                    <div class="rule-number">4</div>
                    <div>Help keep the community safe.</div>
                </div>
            </div>

            <div class="sidebar-card">
                <h3>Remember</h3>
                <p>
                    It's okay to take things one step
                    at a time. Your feelings matter.
                </p>
            </div>
        </aside>

    </div>

</main>

<!-- Optional Live Search JS Enhancement -->
<script>
document.getElementById('searchInput')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase();
    const posts = document.querySelectorAll('.modern-post');
    
    posts.forEach(post => {
        const text = post.getAttribute('data-content');
        if (text.includes(term)) {
            post.style.display = 'block';
        } else {
            post.style.display = 'none';
        }
    });
});
</script>

<?php
renderFooter();
?>