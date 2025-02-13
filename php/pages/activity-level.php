<?php  
session_start(); // Start the session  

// Check if a language is set in the session, otherwise default to Persian  
if (isset($_SESSION['language'])) {  
    $language = $_SESSION['language'];  
} else {  
    $language = 'fa'; // Default language  
}  

// Assume BMI value is set in a session variable or calculated previously  
$bmi = isset($_SESSION['bmi']) ? $_SESSION['bmi'] : 0; // Replace with actual BMI calculation logic  
?>  
<!DOCTYPE html>  
<html lang="<?php echo $language; ?>"> <!-- Set language dynamically -->  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo $language === 'en' ? 'Activity Level - Health App' : 'سطح فعالیت - اپلیکیشن سلامت'; ?></title>  
    <link href="../../src/css/tabler.min.css" rel="stylesheet">  
    <link href="../../src/css/styles.css" rel="stylesheet">  
        <!-- Font Links -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Montserrat.ttf"> <!-- Montserrat -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Vazir.ttf"> <!-- Vazir, ensure the path is correct -->  

    <style>  
        body {  
            text-align: <?php echo $language === 'fa' ? 'right' : 'center'; ?>;  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>; 
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */  
        }  
        .error {  
            color: red;  
            margin-top: 10px;  
        }  

        .logo{
            margin-left: 20px;
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        .signup-button svg {  
            margin-right: 5px; /* Adds space between the icon and text */  
            vertical-align: middle; /* Aligns the SVG icon with the middle of the text */ 
        }  

    </style>  
    <script>  
        // Function to handle the "Submit" button click  
        function handleActivityLevelSubmit(event) {  
            event.preventDefault(); // Prevent the default form submission  

            var activityLevel = document.querySelector('select[name="activity_level"]').value; // Get the selected activity level  
            var errorMsg = document.getElementById('error-message'); // Get the error message element  

            // Clear previous error message  
            errorMsg.textContent = '';  

            // Check if an activity level is selected  
            if (!activityLevel) {  
                errorMsg.textContent = '<?php echo $language === 'en' ? "Please select your activity level." : "لطفاً سطح فعالیت خود را انتخاب کنید."; ?>';  
                return; // Stop further processing if no selection is made  
            }  

            var bmi = <?php echo $bmi; ?>; // Get the BMI value from PHP  

            if (bmi > 25) {  
                // Redirect to suggestion.php if BMI is above 25  
                window.location.href = 'suggestion.php';  
            } else {  
                // Redirect to home if BMI is 25 or below  
                window.location.href = 'home.php';  
            }  
        }  
    </script>  
</head>  

<body>  
    <div class="login-container">   
        <form onsubmit="handleActivityLevelSubmit(event)" autocomplete="off" novalidate>  
        <img src="../../src/img/logo.png" alt="Health App Logo" class="logo">
            <h1>  
                <?php echo $language === 'en' ? 'Activity Level' : 'سطح فعالیت'; ?>  
            </h1>  
            <p>  
                <?php echo $language === 'en'  
                    ? 'Please select your level of physical activity.'  
                    : 'لطفاً سطح فعالیت بدنی خود را انتخاب کنید.'; ?>  
            </p>  

            <!-- Activity Level Options -->  
            <div>  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Select Activity Level' : 'سطح فعالیت خود را انتخاب کنید'; ?>  
                </label>  
                <select name="activity_level" class="form-control" required>  
                    <option value=""><?php echo $language === 'en' ? 'Choose an option' : 'یک گزینه را انتخاب کنید'; ?></option>  
                    <option value="sedentary">  
                        <?php echo $language === 'en' ? 'Sedentary (little or no exercise)' : 'کم تحرک (بدون ورزش یا فعالیت کم)'; ?>  
                    </option>  
                    <option value="light">  
                        <?php echo $language === 'en' ? 'Lightly active (light exercise/sports 1-3 days a week)' : 'فعالیت سبک (ورزش سبک ۱-۳ روز در هفته)'; ?>  
                    </option>  
                    <option value="moderate">  
                        <?php echo $language === 'en' ? 'Moderately active (moderate exercise/sports 3-5 days a week)' : 'فعالیت متوسط (ورزش متوسط ۳-۵ روز در هفته)'; ?>  
                    </option>  
                    <option value="active">  
                        <?php echo $language === 'en' ? 'Active (intense exercise/sports 6-7 days a week)' : 'فعال (ورزش شدید ۶-۷ روز در هفته)'; ?>  
                    </option>  
                    <option value="very_active">  
                        <?php echo $language === 'en' ? 'Very active (very intense exercise or physical job)' : 'بسیار فعال (ورزش بسیار شدید یا شغل فیزیکی)'; ?>  
                    </option>  
                </select>  
            </div>  

            <!-- Error Message Display -->  
            <div id="error-message" class="error"></div>  

            <!-- Submit Button -->  
            <button type="submit" class="btn-primary">  
                <?php echo $language === 'en' ? 'Submit Activity Level' : 'ارسال سطح فعالیت'; ?>  
            </button>  
        </form>  
        <a href="body-type.php" class="signup-button">  
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">  
                <path fill="none" d="M0 0h24v24H0z" />>  
                <path  
                    d="M7 12l5-5v3h4v4h-4v3zM20 4v16a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1z" />  
            </svg>
            <?php echo $language === 'en' ? 'Back to body-type' : 'بازگشت به نوع بدن'; ?>  
        </a>  
    </div>   
</body>  
</html>