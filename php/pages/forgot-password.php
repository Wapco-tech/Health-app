<?php
session_start(); // Start the session  

// Check if a language is set in the session, otherwise default to Persian  
if (isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
} else {
    $language = 'fa'; // Default language  
}
?>
<!DOCTYPE html>
<html lang="<?php echo $language; ?>"> <!-- Set language dynamically -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language === 'en' ? 'Forgot Password - Health App' : 'فراموشی رمز عبور - اپلیکیشن سلامت'; ?>
    </title>
    <link href="../../src/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->
    <link href="../../src/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->
        <!-- Font Links -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Montserrat.ttf"> <!-- Montserrat -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Vazir.ttf"> <!-- Vazir, ensure the path is correct -->

    <style>
        body {
            text-align:
                <?php echo $language === 'fa' ? 'right' : 'center'; ?>
            ;
            /* Align text based on language */
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */
        }

        .forgot-password-container {
            direction:
                <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>
            ;
            /* Set text direction */
        }
    </style>
</head>

<body>
    <div class="forgot-password-container">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="index.php" class="navbar-brand navbar-brand-autodark">
                    <img src="../../src/images/logo.svg" alt="Health App Logo" width="110" height="32">
                </a>
            </div>
            <form class="card card-md" action="process_forgot_password.php" method="POST" autocomplete="off" novalidate>
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">
                        <?php echo $language === 'en' ? 'Forgot Password' : 'فراموشی رمز عبور'; ?>
                    </h2>
                    <p class="text-secondary mb-4">
                        <?php echo $language === 'en'
                            ? 'Enter your email or phone number to reset your password.'
                            : 'ایمیل یا شماره موبایل خود را وارد کنید تا رمز عبور شما بازنشانی شود.'; ?>
                    </p>

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label class="form-label">
                            <?php echo $language === 'en' ? 'Email Address' : 'ایمیل'; ?>
                        </label>
                        <input type="email" name="email" class="form-control"
                            placeholder="<?php echo $language === 'en' ? 'Enter your email' : 'ایمیل خود را وارد کنید'; ?>">
                    </div>

                    <!-- Phone Number Input -->
                    <div class="mb-3">
                        <label class="form-label">
                            <?php echo $language === 'en' ? 'Phone Number' : 'شماره موبایل'; ?>
                        </label>
                        <input type="text" name="phone" class="form-control"
                            placeholder="<?php echo $language === 'en' ? 'Enter your phone number' : 'شماره موبایل خود را وارد کنید'; ?>">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-footer">
                        <button type="submit"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                <path d="M3 7l9 6l9 -6" />
                            </svg>
                            <?php echo $language === 'en' ? 'Send Reset Link' : 'ارسال لینک بازنشانی'; ?>
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-center text-secondary mt-3">
                <?php echo $language === 'en'
                    ? 'Remember your password? <a href="login.php">Go back to login</a>.'
                    : 'رمز عبور خود را به یاد آورده‌اید؟ <a href="login.php">بازگشت به ورود</a>'; ?>
            </div>
        </div>
    </div>

    <!-- Include the same JavaScript file for language switching -->
    <script src="../../js/login.js"></script>
</body>

</html>