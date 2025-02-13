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
    <title><?php echo $language === 'en' ? 'Sign In - Health App' : 'ورود - اپلیکیشن سلامت'; ?></title>  
    <link href="../../src/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->  
    <link href="../../src/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->  

    <style>  
        @font-face {  
            font-family: 'Montserrat';  
            src: url('../../src/css/fonts/Montserrat.woff') format('woff'), /* Adjust the path based on your directory structure */  
                 url('../../src/css/fonts/Montserrat.ttf') format('truetype'); /* Fallback to TTF if WOFF is not available */  
            font-weight: normal; /* You can specify font-weight if you have multiple weights */  
            font-style: normal; /* Specify the style if needed (normal/italic) */  
        }  

        @font-face {  
            font-family: 'Vazir';  
            src: url('../../src/css/fonts/Vazir.woff') format('woff'), /* Adjust the path based on your directory structure */  
                 url('../../src/css/fonts/Vazir.ttf') format('truetype'); /* Fallback to TTF if WOFF is not available */  
            font-weight: normal; /* You can specify font-weight if you have multiple weights */  
            font-style: normal; /* Specify the style if needed (normal/italic) */  
        }  

        body {  
            text-align: <?php echo $language === 'fa' ? 'right' : 'center'; ?>; /* Align text based on language */  
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */  
        }  

        .login-container {  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>; /* Set text direction */  
        }  
    </style>  
</head>  

<body>  

    <div class="login-container">  
        <div class="container container-tight py-4">  

            <h1 id="login-title"><?php echo $language === 'en' ? 'Sign In' : 'ورود'; ?></h1>  
            <p id="login-subtitle">  
                <?php echo $language === 'en' ? 'Welcome back to your favorite health app!' : 'به اپلیکیشن سلامت خود خوش آمدید'; ?>  
            </p>  
            <!-- Redirect directly to home.php -->  
            <form action="home.php" method="GET">  
                <input type="text" class="form-control" id="username" name="username"  
                    placeholder="<?php echo $language === 'en' ? 'Enter your email' : 'نام کاربری'; ?>">  
                <input type="password" class="form-control" id="password" name="password"  
                    placeholder="<?php echo $language === 'en' ? 'Enter your password' : 'رمز عبور'; ?>">  
                <div class="mb-2">  
                    <a href="forgot-password.php"  
                        class="forgot-password"><?php echo $language === 'en' ? 'Forgot your password?' : 'رمز عبور خود را فراموش کرده‌اید؟'; ?></a>  
                </div>  
                <button type="submit"  
                    class="btn btn-primary"><?php echo $language === 'en' ? 'Enter' : 'ورود'; ?></button>  
            </form>  

            <!-- Sign Up Button -->  
            <div class="mt-3">  
                <a href="signup.php" class="signup-button"><?php echo $language === 'en' ? 'Sign Up' : 'ثبت نام'; ?></a>  
            </div>  

            <!-- Language Select Box -->  
            <select id="language-select" class="form-select language-select" onchange="switchLanguage(this.value)">  
                <option value="fa" <?php echo $language === 'fa' ? 'selected' : ''; ?>>فا</option>  
                <option value="en" <?php echo $language === 'en' ? 'selected' : ''; ?>>En</option>  
            </select>  
        </div>  
    </div>  

    <script src="../../js/login.js"></script> <!-- Link to your JavaScript file -->  

</body>  

</html>