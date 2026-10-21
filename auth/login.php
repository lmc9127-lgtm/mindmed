<?php

session_start();

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../includes/layout.php";
$message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email =
    trim($_POST["email"]);

    $password =
    $_POST["password"];


    $sql = $conn->prepare(
        "SELECT *
        FROM users
        WHERE email = ?"
    );

    $sql->execute([
        $email
    ]);

    $user =
    $sql->fetch();


    if ($user) {

        if (
            password_verify(
                $password,
                $user["password_hash"]
            )
        ) {

            $_SESSION["user_id"] =
            $user["user_id"];

            $_SESSION["pseudo_name"] =
            $user["pseudo_name"];


            header(
                "Location: ../dashboard.php"
            );

            exit();

        } else {

            $message =
            "Incorrect password.";

        }

    } else {

        $message =
        "Account not found.";

    }

}


renderHead("Login | MindMend");
renderHeader("../");

?>


<div class="form-page">

<div class="form-card">

    <h1>Welcome back</h1>

    <p class="subtitle">
        Login to continue to the community.
    </p>


    <?php if ($message != ""): ?>

        <div class="alert alert-error">

            <?php
            echo htmlspecialchars($message);
            ?>

        </div>

    <?php endif; ?>


    <form method="POST">


        <div class="form-group">

            <label>Email Address</label>

            <input
            type="email"
            name="email"
            placeholder="Enter your email"
            required>

        </div>


        <div class="form-group">

            <label>Password</label>

            <input
            type="password"
            name="password"
            placeholder="Enter your password"
            required>

        </div>


        <button
        type="submit"
        class="btn">

            Login

        </button>


    </form>


    <p style="
    text-align:center;
    margin-top:20px;
    color:#74817c;
    font-size:14px;
    ">

        Don't have an account?

        <a
        href="register.php"
        style="
        color:#52796f;
        text-decoration:none;
        font-weight:bold;
        ">

            Register

        </a>

    </p>

</div>

</div>


<?php

renderFooter();

?>