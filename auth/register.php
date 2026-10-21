<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../includes/layout.php";

$message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo_name =
    trim($_POST["pseudo_name"]);

    $email =
    trim($_POST["email"]);

    $password =
    $_POST["password"];


    $check = $conn->prepare(
        "SELECT user_id
        FROM users
        WHERE email = ?
        OR pseudo_name = ?"
    );

    $check->bind_param(
        "ss",
        $email,
        $pseudo_name
    );

    $check->execute();

    $result =
    $check->get_result();


    if ($result->num_rows > 0) {

        $message =
        "Email or pseudonym already exists.";

    } else {

        $password_hash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        $sql = $conn->prepare(
            "INSERT INTO users
            (pseudo_name, email, password_hash)
            VALUES (?, ?, ?)"
        );


        $sql->bind_param(
            "sss",
            $pseudo_name,
            $email,
            $password_hash
        );


        if ($sql->execute()) {

            header(
                "Location: login.php"
            );

            exit();

        } else {

            $message =
            "Registration failed.";

        }

    }

}


renderHead("Register | MindMend");
renderHeader("../");

?>


<div class="form-page">

<div class="form-card">

    <h1>Create an account</h1>

    <p class="subtitle">
        Join the MindMend community.
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

            <label>Enter Name</label>

            <input
            type="text"
            name="pseudo_name"
            placeholder="Choose a username"
            required>

        </div>


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
            placeholder="Create a password"
            required>

        </div>


        <button
        type="submit"
        class="btn">

            Create Account

        </button>


    </form>


    <p style="
    text-align:center;
    margin-top:20px;
    color:#74817c;
    font-size:14px;
    ">

        Already have an account?

        <a
        href="login.php"
        style="
        color:#52796f;
        text-decoration:none;
        font-weight:bold;
        ">

            Login

        </a>

    </p>

</div>

</div>


<?php

renderFooter();

?>