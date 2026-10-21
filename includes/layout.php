<?php

function renderHead($title = "MindMend") {
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title><?php echo htmlspecialchars($title); ?></title>

<style>

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

:root {
    --primary: #52796f;
    --primary-dark: #354f52;
    --primary-light: #e9f1ee;
    --background: #f6f8f7;
    --white: #ffffff;
    --text: #2f3e46;
    --muted: #74817c;
    --border: #dfe7e3;
    --danger: #c95d63;
    --shadow: 0 8px 30px rgba(40, 60, 55, 0.08);
    --radius: 16px;
}

body {
    font-family: Arial, sans-serif;
    background: var(--background);
    color: var(--text);
    line-height: 1.6;
}

/* NAVIGATION */

header {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 16px 8%;

    display: flex;
    justify-content: space-between;
    align-items: center;

    position: sticky;
    top: 0;
    z-index: 100;
}

.logo {
    color: var(--primary-dark);
    font-size: 24px;
    font-weight: bold;
}

.logo span {
    color: var(--primary);
}

nav {
    display: flex;
    align-items: center;
    gap: 8px;
}

nav a {
    color: var(--muted);
    text-decoration: none;
    padding: 9px 14px;
    border-radius: 8px;
    font-size: 14px;
}

nav a:hover {
    background: var(--primary-light);
    color: var(--primary-dark);
}

/* GENERAL */

.container {
    width: 90%;
    max-width: 1000px;
    margin: auto;
}

.page {
    padding: 45px 0;
}

.card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 25px;
    box-shadow: var(--shadow);
}

.btn {
    display: inline-block;
    background: var(--primary);
    color: white;
    text-decoration: none;
    border: none;
    padding: 11px 18px;
    border-radius: 9px;
    cursor: pointer;
    font-size: 14px;
}

.btn:hover {
    background: var(--primary-dark);
}

.btn-light {
    background: var(--primary-light);
    color: var(--primary-dark);
}

.btn-danger {
    background: var(--danger);
}

/* FORMS */

.form-page {
    min-height: calc(100vh - 70px);

    display: flex;
    justify-content: center;
    align-items: center;

    padding: 40px 20px;
}

.form-card {
    width: 100%;
    max-width: 460px;

    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius);

    padding: 35px;
    box-shadow: var(--shadow);
}

.form-card h1 {
    color: var(--primary-dark);
    margin-bottom: 8px;
}

.subtitle {
    color: var(--muted);
    margin-bottom: 25px;
}

.form-group {
    margin-bottom: 18px;
}

label {
    display: block;
    margin-bottom: 7px;
    font-size: 14px;
    font-weight: bold;
}

input,
textarea,
select {
    width: 100%;
    padding: 12px;
    border: 1px solid var(--border);
    border-radius: 9px;
    font-size: 14px;
    font-family: Arial, sans-serif;
}

textarea {
    resize: vertical;
}

input:focus,
textarea:focus,
select:focus {
    outline: none;
    border-color: var(--primary);
}

.form-card button {
    width: 100%;
}

/* ALERT */

.alert {
    padding: 12px;
    margin-bottom: 18px;
    border-radius: 8px;
    font-size: 14px;
}

.alert-error {
    background: #fff0f1;
    color: #a94449;
}

.alert-success {
    background: var(--primary-light);
    color: var(--primary-dark);
}

/* POSTS */

.post {
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 22px;
    margin-bottom: 18px;
}

.post-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 38px;
    height: 38px;
    background: var(--primary-light);
    color: var(--primary-dark);

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;
    font-weight: bold;
}

.category {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary-dark);

    padding: 5px 10px;
    border-radius: 20px;

    font-size: 12px;
    margin-bottom: 12px;
}

.post-content {
    color: #4b5752;
    margin-bottom: 18px;
}

.post-actions {
    border-top: 1px solid var(--border);
    padding-top: 14px;

    display: flex;
    gap: 15px;
}

.post-actions a {
    text-decoration: none;
    font-size: 14px;
    color: var(--muted);
}

.post-actions a:hover {
    color: var(--primary);
}

.edit {
    color: #5578a5 !important;
}

.delete {
    color: var(--danger) !important;
}

/* HERO */

.hero {
    min-height: 600px;

    display: flex;
    align-items: center;
    justify-content: center;

    text-align: center;

    padding: 60px 20px;

    background:
    linear-gradient(
        135deg,
        #2dc077,
        #0d8449
    );
}

.hero-content {
    max-width: 750px;
}

.hero h1 {
    font-size: 55px;
    line-height: 1.15;
    color: var(--primary-dark);
    margin-bottom: 20px;
}

.hero h1 span {
    color: var(--primary);
}

.hero p {
    max-width: 600px;
    margin: auto;
    color: var(--muted);
    font-size: 17px;
}

.hero-buttons {
    margin-top: 30px;
}

/* FEATURES */

.features {
    padding: 70px 0;
}

.section-title {
    text-align: center;
    margin-bottom: 35px;
}

.section-title h2 {
    color: var(--primary-dark);
}

.feature-grid {
    display: grid;

    grid-template-columns:
    repeat(auto-fit, minmax(230px, 1fr));

    gap: 20px;
}

.feature {
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius);

    padding: 25px;
}

.feature h3 {
    color: var(--primary-dark);
    margin: 12px 0;
}

.feature p {
    color: var(--muted);
    font-size: 14px;
}

/* DASHBOARD */

.welcome {
    background: var(--primary);
    color: white;

    padding: 30px;
    border-radius: var(--radius);

    margin-bottom: 30px;
}

.welcome p {
    opacity: 0.85;
    margin-top: 5px;
}

.welcome .btn {
    margin-top: 18px;
    background: white;
    color: var(--primary-dark);
}

.feed-header {
    margin-bottom: 20px;
}

.feed-header h2 {
    color: var(--primary-dark);
}

.feed-header p {
    color: var(--muted);
}

/* COMMENTS */

.comment {
    padding: 16px 0;
    border-bottom: 1px solid var(--border);
}

.comment:last-child {
    border-bottom: none;
}

.comment-name {
    font-weight: bold;
    color: var(--primary-dark);
}

.comment-text {
    color: var(--muted);
    margin-top: 5px;
}

/* FOOTER */

footer {
    margin-top: 50px;
    padding: 25px;
    text-align: center;
    color: var(--muted);
    font-size: 13px;
}

/* MOBILE */

@media (max-width: 600px) {

    header {
        padding: 14px 5%;
    }

    .hero h1 {
        font-size: 38px;
    }

    nav a {
        padding: 7px;
    }

    .post-top {
        align-items: flex-start;
    }

}

</style>

</head>

<body>

<?php
}


function renderHeader($base = "") {
?>

<header>

    <div class="logo">
        Mind<span>Mend</span>
    </div>

    <nav>

        <a href="<?php echo $base; ?>index.php">
            Home
        </a>

        <?php if (isset($_SESSION["user_id"])): ?>

            <a href="<?php echo $base; ?>dashboard.php">
                Community
            </a>

            <a href="<?php echo $base; ?>auth/logout.php">
                Logout
            </a>

        <?php else: ?>

            <a href="<?php echo $base; ?>auth/login.php">
                Login
            </a>

            <a href="<?php echo $base; ?>auth/register.php">
                Register
            </a>

        <?php endif; ?>

    </nav>

</header>

<?php
}


function renderFooter() {
?>

<footer>

    © <?php echo date("Y"); ?>
    MindMend · Anonymous Peer Support

</footer>

</body>
</html>

<?php
}
?>