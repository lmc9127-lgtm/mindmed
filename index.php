    <?php

    session_start();

    require_once __DIR__ . '/includes/layout.php';

    renderHead("MindMend | Home");
    renderHeader();

    ?>

    <style>

    /* =========================================
    HOMEPAGE DESIGN
    ========================================= */

    .homepage {
        overflow: hidden;
    }


    /* HERO */

    .home-hero {
        min-height: 650px;

        display: flex;
        align-items: center;

        position: relative;

        padding: 80px 0;

        background:
            radial-gradient(
                circle at top left,
                #e5f1ec,
                transparent 40%
            ),
            #f7f9f8;
    }

    .home-hero::before {
        content: "";

        position: absolute;

        width: 350px;
        height: 350px;

        border-radius: 50%;

        background: #dcebe4;

        right: -100px;
        bottom: -100px;

        opacity: 0.6;
    }

    .hero-container {
        width: 90%;
        max-width: 1150px;

        margin: auto;

        position: relative;

        display: grid;

        grid-template-columns:
            1.2fr 0.8fr;

        gap: 60px;

        align-items: center;
    }


    /* HERO TEXT */

    .hero-label {
        display: inline-flex;

        align-items: center;

        gap: 8px;

        background: #e7f1ec;

        color: #52796f;

        padding: 8px 13px;

        border-radius: 30px;

        font-size: 12px;
        font-weight: bold;

        letter-spacing: 0.5px;

        margin-bottom: 22px;
    }

    .hero-title {
        font-size: clamp(42px, 5vw, 68px);

        line-height: 1.08;

        color: #354f52;

        margin-bottom: 22px;

        letter-spacing: -2px;
    }

    .hero-title span {
        color: #52796f;
    }

    .hero-description {
        max-width: 600px;

        color: #71807a;

        font-size: 17px;

        line-height: 1.8;

        margin-bottom: 30px;
    }


    /* HERO BUTTONS */

    .hero-buttons-modern {
        display: flex;

        align-items: center;

        gap: 12px;

        flex-wrap: wrap;
    }

    .primary-home-btn {
        background: #52796f;

        color: white;

        text-decoration: none;

        padding: 13px 22px;

        border-radius: 10px;

        font-size: 14px;
        font-weight: bold;

        transition: 0.2s;
    }

    .primary-home-btn:hover {
        background: #354f52;

        transform: translateY(-2px);
    }

    .secondary-home-btn {
        background: white;

        color: #52796f;

        border: 1px solid #dfe7e3;

        text-decoration: none;

        padding: 13px 22px;

        border-radius: 10px;

        font-size: 14px;
        font-weight: bold;

        transition: 0.2s;
    }

    .secondary-home-btn:hover {
        background: #eef5f1;
    }


    /* HERO CARD */

    .hero-visual {
        display: flex;

        justify-content: center;
    }

    .support-preview {
        width: 100%;
        max-width: 380px;

        background: white;

        border: 1px solid #e1e8e4;

        border-radius: 22px;

        padding: 25px;

        box-shadow:
            0 20px 50px
            rgba(53, 79, 82, 0.10);

        position: relative;
    }

    .preview-top {
        display: flex;

        align-items: center;

        gap: 10px;

        padding-bottom: 18px;

        border-bottom:
            1px solid #edf1ef;

        margin-bottom: 20px;
    }

    .preview-avatar {
        width: 42px;
        height: 42px;

        border-radius: 50%;

        background: #e8f1ed;

        color: #52796f;

        display: flex;

        align-items: center;
        justify-content: center;

        font-weight: bold;
    }

    .preview-user strong {
        display: block;

        color: #354f52;

        font-size: 14px;
    }

    .preview-user span {
        color: #98a39f;

        font-size: 12px;
    }

    .preview-tag {
        display: inline-block;

        background: #eef5f1;

        color: #52796f;

        padding: 5px 10px;

        border-radius: 20px;

        font-size: 11px;

        margin-bottom: 12px;
    }

    .preview-text {
        color: #596661;

        font-size: 14px;

        line-height: 1.7;

        margin-bottom: 20px;
    }

    .preview-support {
        background: #f5f8f6;

        border-radius: 12px;

        padding: 13px;

        color: #63706b;

        font-size: 13px;

        line-height: 1.5;
    }


    /* TRUST SECTION */

    .trust-section {
        background: white;

        border-top:
            1px solid #edf1ef;

        border-bottom:
            1px solid #edf1ef;

        padding: 28px 0;
    }

    .trust-container {
        width: 90%;
        max-width: 1000px;

        margin: auto;

        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 20px;

        text-align: center;
    }

    .trust-item {
        color: #63706b;

        font-size: 13px;
    }

    .trust-icon {
        display: block;

        font-size: 22px;

        margin-bottom: 5px;
    }


    /* SECTION GENERAL */

    .home-section {
        padding: 90px 0;
    }

    .home-container {
        width: 90%;
        max-width: 1100px;

        margin: auto;
    }

    .home-section-title {
        text-align: center;

        max-width: 650px;

        margin: auto auto 50px;
    }

    .home-section-title span {
        color: #52796f;

        font-size: 12px;

        font-weight: bold;

        letter-spacing: 1px;
    }

    .home-section-title h2 {
        color: #354f52;

        font-size: 34px;

        margin: 10px 0 12px;
    }

    .home-section-title p {
        color: #74817c;

        font-size: 15px;

        line-height: 1.7;
    }


    /* FEATURE CARDS */

    .home-features {
        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 20px;
    }

    .home-feature {
        background: white;

        border:
            1px solid #e1e8e4;

        border-radius: 18px;

        padding: 28px;

        transition: 0.2s;
    }

    .home-feature:hover {
        transform: translateY(-4px);

        box-shadow:
            0 15px 35px
            rgba(50, 70, 60, 0.07);
    }

    .feature-icon-modern {
        width: 48px;
        height: 48px;

        background: #e8f1ed;

        border-radius: 14px;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 22px;

        margin-bottom: 20px;
    }

    .home-feature h3 {
        color: #354f52;

        margin-bottom: 10px;

        font-size: 17px;
    }

    .home-feature p {
        color: #74817c;

        font-size: 14px;

        line-height: 1.7;
    }


    /* HOW IT WORKS */

    .steps-section {
        background: #f0f5f2;
    }

    .steps-grid {
        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 25px;
    }

    .step {
        text-align: center;

        padding: 20px;
    }

    .step-number {
        width: 48px;
        height: 48px;

        margin: 0 auto 18px;

        border-radius: 50%;

        background: #52796f;

        color: white;

        display: flex;

        align-items: center;
        justify-content: center;

        font-weight: bold;
    }

    .step h3 {
        color: #354f52;

        margin-bottom: 10px;

        font-size: 16px;
    }

    .step p {
        color: #74817c;

        font-size: 14px;

        line-height: 1.6;
    }


    /* CTA SECTION */

    .home-cta {
        background: #52796f;

        border-radius: 24px;

        padding: 55px 30px;

        text-align: center;

        color: white;
    }

    .home-cta h2 {
        font-size: 32px;

        margin-bottom: 12px;
    }

    .home-cta p {
        opacity: 0.9;

        max-width: 550px;

        margin: auto auto 25px;

        line-height: 1.7;
    }

    .cta-white-btn {
        display: inline-block;

        background: white;

        color: #354f52;

        text-decoration: none;

        padding: 13px 22px;

        border-radius: 10px;

        font-size: 14px;
        font-weight: bold;

        transition: 0.2s;
    }

    .cta-white-btn:hover {
        transform: translateY(-2px);
    }


    /* RESPONSIVE */

    @media (max-width: 850px) {

        .hero-container {
            grid-template-columns: 1fr;
        }

        .hero-content-modern {
            text-align: center;
        }

        .hero-description {
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons-modern {
            justify-content: center;
        }

        .hero-visual {
            margin-top: 10px;
        }

        .home-features,
        .steps-grid {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 600px) {

        .home-hero {
            min-height: auto;

            padding: 65px 0;
        }

        .hero-title {
            font-size: 43px;
        }

        .trust-container {
            grid-template-columns: 1fr;

            gap: 15px;
        }

        .home-section {
            padding: 65px 0;
        }

        .home-section-title h2 {
            font-size: 28px;
        }

    }

    </style>


    <main class="homepage">


        <!-- HERO SECTION -->

        <section class="home-hero">

            <div class="hero-container">


                <div class="hero-content-modern">


                    <div class="hero-label">

                        🌿 A SAFE SPACE FOR STUDENTS

                    </div>


                    <h1 class="hero-title">

                        You don't have to

                        <span>
                            face everything alone.
                        </span>

                    </h1>


                    <p class="hero-description">

                        MindMend is an anonymous peer-support
                        community where students can share their
                        thoughts, connect with others, and find
                        encouragement in a safe and respectful space.

                    </p>


                    <div class="hero-buttons-modern">


                        <?php if (isset($_SESSION["user_id"])): ?>


                            <a
                            href="dashboard.php"
                            class="primary-home-btn">

                                Enter Community →

                            </a>


                        <?php else: ?>


                            <a
                            href="auth/register.php"
                            class="primary-home-btn">

                                Join MindMend →

                            </a>


                            <a
                            href="auth/login.php"
                            class="secondary-home-btn">

                                Login

                            </a>


                        <?php endif; ?>


                    </div>


                </div>



                <!-- PREVIEW CARD -->

                <div class="hero-visual">


                    <div class="support-preview">


                        <div class="preview-top">


                            <div class="preview-avatar">
                                ?
                            </div>


                            <div class="preview-user">

                                <strong>
                                    Anonymous Student
                                </strong>

                                <span>
                                    Just now
                                </span>

                            </div>


                        </div>


                        <div class="preview-tag">

                            #AcademicPressure

                        </div>


                        <p class="preview-text">

                            "Lately, everything feels overwhelming.
                            I just wanted a place where I could say
                            what I'm feeling without being judged."

                        </p>


                        <div class="preview-support">

                            💬 Someone from the community:
                            "You're not alone. Take things one
                            step at a time."

                        </div>


                    </div>


                </div>


            </div>

        </section>



        <!-- TRUST SECTION -->

        <section class="trust-section">

            <div class="trust-container">


                <div class="trust-item">

                    <span class="trust-icon">
                        🔒
                    </span>

                    Privacy-focused space

                </div>


                <div class="trust-item">

                    <span class="trust-icon">
                        💬
                    </span>

                    Supportive peer community

                </div>


                <div class="trust-item">

                    <span class="trust-icon">
                        🌱
                    </span>

                    Built for students

                </div>


            </div>

        </section>



        <!-- FEATURES -->

        <section class="home-section">

            <div class="home-container">


                <div class="home-section-title">

                    <span>
                        WHAT YOU CAN DO
                    </span>

                    <h2>
                        A simple space to be heard
                    </h2>

                    <p>
                        MindMend helps students express themselves,
                        connect with others, and build a supportive
                        community.
                    </p>

                </div>


                <div class="home-features">


                    <div class="home-feature">

                        <div class="feature-icon-modern">
                            🕊
                        </div>

                        <h3>
                            Share Freely
                        </h3>

                        <p>
                            Express your thoughts and experiences
                            in a comfortable environment without
                            pressure to reveal your identity.
                        </p>

                    </div>



                    <div class="home-feature">

                        <div class="feature-icon-modern">
                            💬
                        </div>

                        <h3>
                            Connect & Support
                        </h3>

                        <p>
                            Read community posts and offer
                            respectful encouragement to students
                            who may need support.
                        </p>

                    </div>



                    <div class="home-feature">

                        <div class="feature-icon-modern">
                            🌱
                        </div>

                        <h3>
                            Grow Together
                        </h3>

                        <p>
                            Build a more understanding community
                            where students can listen, share,
                            and support one another.
                        </p>

                    </div>


                </div>


            </div>

        </section>



        <!-- HOW IT WORKS -->

        <section class="home-section steps-section">

            <div class="home-container">


                <div class="home-section-title">

                    <span>
                        HOW IT WORKS
                    </span>

                    <h2>
                        Simple. Private. Supportive.
                    </h2>

                    <p>
                        MindMend makes it easy to participate
                        in a supportive student community.
                    </p>

                </div>


                <div class="steps-grid">


                    <div class="step">

                        <div class="step-number">
                            1
                        </div>

                        <h3>
                            Create an Account
                        </h3>

                        <p>
                            Register using your account and
                            choose a pseudonymous identity.
                        </p>

                    </div>



                    <div class="step">

                        <div class="step-number">
                            2
                        </div>

                        <h3>
                            Share Your Thoughts
                        </h3>

                        <p>
                            Create a post and choose whether
                            you want to share anonymously.
                        </p>

                    </div>



                    <div class="step">

                        <div class="step-number">
                            3
                        </div>

                        <h3>
                            Connect with Others
                        </h3>

                        <p>
                            Read posts and participate through
                            supportive community interactions.
                        </p>

                    </div>


                </div>


            </div>

        </section>



        <!-- CALL TO ACTION -->

        <section class="home-section">

            <div class="home-container">


                <div class="home-cta">


                    <h2>
                        A space where your voice matters.
                    </h2>


                    <p>
                        Join MindMend and become part of a
                        student community built on respect,
                        understanding, and support.
                    </p>


                    <?php if (isset($_SESSION["user_id"])): ?>


                        <a
                        href="dashboard.php"
                        class="cta-white-btn">

                            Go to Community →

                        </a>


                    <?php else: ?>


                        <a
                        href="auth/register.php"
                        class="cta-white-btn">

                            Get Started →

                        </a>


                    <?php endif; ?>


                </div>


            </div>

        </section>


    </main>


    <?php

    renderFooter();

    ?>