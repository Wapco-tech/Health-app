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
    <title><?php echo $language === 'en' ? 'Sign Up - Health App' : 'ثبت نام - اپلیکیشن سلامت'; ?></title>  
    <link href="../../src/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->  
    <link href="../../src/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->  

    <style>  
        @font-face {  
            font-family: 'Montserrat';  
            src: url('../../src/css/fonts/Montserrat.woff') format('woff'), /* Adjust the path based on your directory structure */  
                 url('../../src/css/fonts/Montserrat.ttf') format('truetype'); /* Fallback to TTF if WOFF is not available */  
            font-weight: normal;  
            font-style: normal;  
        }  

        @font-face {  
            font-family: 'Vazir';  
            src: url('../../src/css/fonts/Vazir.woff') format('woff'), /* Adjust the path based on your directory structure */  
                 url('../../src/css/fonts/Vazir.ttf') format('truetype'); /* Fallback to TTF if WOFF is not available */  
            font-weight: normal;  
            font-style: normal;  
        }  

        body {  
            text-align: <?php echo $language === 'fa' ? 'right' : 'center'; ?>; /* Align text based on language */  
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */  
        }  
        .signup-container {  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>; /* Set text direction */  
        }  
    </style>  
</head>  
<body>  
    <div class="signup-container">  
        <h1 id="signup-title"><?php echo $language === 'en' ? 'Sign Up' : 'ثبت نام'; ?></h1>  
        <p id="signup-subtitle"><?php echo $language === 'en' ? 'Welcome to your favorite health app!' : 'به اپلیکیشن سلامت خود خوش آمدید!'; ?></p>  
        <!-- Redirect directly to introduction.php -->  
        <form action="introduction.php" method="GET">  
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="<?php echo $language === 'en' ? 'Mobile Number' : 'شماره موبایل'; ?>">  
            <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $language === 'en' ? 'Email' : 'ایمیل'; ?>">  
            <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo $language === 'en' ? 'Password' : 'رمز عبور'; ?>">  
            <button type="submit" class="btn btn-primary"><?php echo $language === 'en' ? 'Sign Up' : 'ثبت نام'; ?></button>  
        </form>  
        <a href="login.php" class="login-link"><?php echo $language === 'en' ? 'Already registered? Log in' : 'قبلاً ثبت نام کرده‌اید؟ وارد شوید'; ?></a>  
    </div>  

    <!-- Include the same JavaScript file for language switching -->  
    <script src="../../js/login.js"></script>   
</body>  
</html>