<?php  
if (session_status() == PHP_SESSION_NONE) {  
    session_start();  
}  

// Check if the variables were set in the session; otherwise, default to 0  
$weight = isset($_SESSION['weight']) ? $_SESSION['weight'] : 0;  
$height = isset($_SESSION['height']) ? $_SESSION['height'] : 0;  
$sex = isset($_SESSION['sex']) ? $_SESSION['sex'] : 'male'; // Get sex from session  
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'fa';  

$bmi = 0;  
$bmiCategory = '';  
$explanation = '';  // Variable for explanation text  

// Function to convert Persian numbers to English  
function convertPersianNumbersToEnglish($input) {  
    $persianToEnglish = [  
        '۰' => '0',  
        '۱' => '1',  
        '۲' => '2',  
        '۳' => '3',  
        '۴' => '4',  
        '۵' => '5',  
        '۶' => '6',  
        '۷' => '7',  
        '۸' => '8',  
        '۹' => '9'  
    ];  
    return str_replace(array_keys($persianToEnglish), array_values($persianToEnglish), $input);  
}  

// Classification function with language support  
$classify = function($bmi, $lang) {  
    if ($lang === 'fa') {  
        if ($bmi < 16) return 'لاغری شدید';  
        if ($bmi >= 16.1 && $bmi < 17) return 'لاغری متوسط';  
        if ($bmi >= 17.1 && $bmi < 18.5) return 'کمبود وزن';  
        if ($bmi >= 18.6 && $bmi < 25) return 'وزن سلامت (نرمال)';  
        if ($bmi >= 25.1 && $bmi < 30) return 'اضافه وزن';  
        if ($bmi >= 30.1 && $bmi < 35) return 'چاقی';  
        return 'چاقی شدید';  
    } else {  
        if ($bmi < 16) return 'Severe Thinness';  
        if ($bmi >= 16.1 && $bmi < 17) return 'Moderate Thinness';  
        if ($bmi >= 17.1 && $bmi < 18.5) return 'Underweight';  
        if ($bmi >= 18.6 && $bmi < 25) return 'Normal Weight';  
        if ($bmi >= 25.1 && $bmi < 30) return 'Overweight';  
        if ($bmi >= 30.1 && $bmi < 35) return 'Obesity';  
        return 'Severe Obesity';  
    }  
};  

function getExplanation($bmi, $sex, $lang) {  
    // Debug lines to check input values  
    error_log("BMI: $bmi, sex: $sex, Language: $lang");  

    if ($lang === 'fa') { // Check if the selected language is Persian  
        if ($sex === 'male') { // Male conditions  
            if ($bmi < 17 ) {  
                return 'هشدار سبک زندگی: کمبود وزن و BMI پایین خطرات خاص خود را دارد که شامل: کمبود ویتامین، کم خونی، افسردگی، خشکی پوست، بیماری‌های قلبی-عروقی، ریزش مو، سیستم ایمنی ضعیف، پوکی استخوان، سوء تغذیه.';  
            }  
        } elseif ($sex === 'female') { // Female conditions  
            if ($bmi < 17) {  
                return 'هشدار سبک زندگی: کمبود وزن و BMI پایین خطرات خاص خود را دارد که شامل: بیماری‌های قلبی-عروقی، افسردگی، ریزش مو، مشکل در باردار شدن، اختلالات قاعدگی، سیستم ایمنی ضعیف، پوکی استخوان، سوء تغذیه.';  
            }  
        }  
        if ($bmi >= 25 && $bmi < 30) {  
            return 'هشدار سبک زندگی: اضافه وزن تاثیرات منفی زیادی بر روی سلامتی دارد که شامل: افزایش فشار خون، افزایش ریسک ابتلا به دیابت نوع دو، کاهش سطح کلسترول خوب خون و افزایش سطح کلسترول بد خون، افزایش کارایی قلب، و بالا رفتن خطر بیماری‌های قلبی.';  
        }  
        if ($bmi >= 30) {  
            return 'هشدار سبک زندگی: چاقی خطرات جدی برای سلامتی دارد که شامل: افزایش فشار خون، ریسک بالای دیابت نوع دو، کاهش سطح کلسترول خوب خون و بالا رفتن سطح کلسترول بد خون، افزایش احتمال سکته‌ها، آرتروز و مشکلات تنفسی مانند آپنه خواب.';  
        }  
    } else { // Language is English  
        if ($sex === 'male') { // Male conditions  
            if ($bmi < 17) {  
                return 'Lifestyle Warning: Being underweight and having a low BMI has specific risks, including: vitamin deficiency, anemia, depression, dry skin, cardiovascular diseases, hair loss, weak immune system, osteoporosis, malnutrition.';  
            }  
        } elseif ($sex === 'female') { // Female conditions  
            if ($bmi < 17) {  
                return 'Lifestyle Warning: Being underweight and having a low BMI has specific risks, including: cardiovascular diseases, depression, hair loss, difficulty getting pregnant, menstrual disorders, weak immune system, osteoporosis, malnutrition.';  
            }  
        }  
        if ($bmi >= 25 && $bmi < 30) {  
            return 'Lifestyle Warning: Being overweight has many negative health impacts, including: increased blood pressure, increased risk of type 2 diabetes, reduced HDL cholesterol levels, increased LDL cholesterol levels, increased workload on the heart, increased risk of cardiovascular diseases.';  
        }  
        if ($bmi >= 30) {  
            return 'Lifestyle Warning: Obesity has many negative health impacts including: increased blood pressure, increased risk of type 2 diabetes, reduced HDL cholesterol levels, increased LDL cholesterol levels, increased risk of various heart and brain attacks, sleep apnea and respiratory problems, increased risk of gallbladder disease, increased cancer risk.';  
        }  
    }  

    // Return a default message if none of the conditions match  
    return '';  
}  

// Calculate BMI if height is provided in cm  
if ($height > 0 && $weight > 0) {  
    $heightInMeters = $height / 100;  
    $bmi = $weight / ($heightInMeters * $heightInMeters);  
    $bmiCategory = $classify($bmi, $language);  
    $explanation = getExplanation($bmi, $sex, $language);  // Get BMI explanation based on sex and language  
    $_SESSION['bmi'] = $bmi; // Store BMI in session for later use  
}  

// Check if there's a post request to store user data  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $_SESSION['weight'] = convertPersianNumbersToEnglish($_POST['weight']);  
    $_SESSION['height'] = convertPersianNumbersToEnglish($_POST['height']);  
    $_SESSION['sex'] = $_POST['sex']; // Capture sex from post request  
    header('Location: loader2.php');  
    exit;  
}  
?>

<!DOCTYPE html>  
<html lang="<?php echo $language; ?>"> <!-- Set language dynamically -->  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   

    <!-- Tabler CSS -->  
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">  
    
    <style>   
        * {  
            margin: 0;  
            padding: 0;  
            box-sizing: border-box; /* Ensure proper box sizing */  
        }  

        body {  
            background: #e3edf7; /* Background color */  
            font-family: sans-serif;  
            overflow: hidden; /* Prevent overflow during the animation */  
            height: 100vh; /* Full height of the viewport */ 
            top: 15%; /* Changed top value for better vertical alignment */ 
        }  

        .container {  
            position: relative;  
            margin: 20px auto;  
            border-radius: 20px;  
            background: #435175; /* Background for the loading animation */  
            width: 80%; /* Full width with some margin on mobile */  
            max-width: 800px; /* Max width */  
            height: 70vh; /* Responsive height */  
        }  

        .man {  
            position: absolute;  
            top: 30%; /* Changed top value for better vertical alignment */  
            left: 50%; /* Center horizontally */  
            transform: translateX(-50%); /* Adjust to properly center */  
            width: 55%;  
            height: 45%;  
            z-index: 3;  
        }  

        /* Man and arm configuration */  
        .man .legs {  
            position: absolute;  
            width: 20%;  
            height: 64%;  
            bottom: 4%;  
        }  

        .man .legs .leg {  
            position: absolute;  
            width: 20%;  
            height: 100%;  
            border-top-left-radius: 30px;  
            border-top-right-radius: 30px;  
        }  

        .man .legs .leg::after,  
        .man .legs .leg::before {  
            content: "";  
            background: #53313e;  
            position: absolute;  
            width: 100%;  
            height: 5%;  
        }  

        .man .legs .leg::before {  
            width: 50%;  
            height: 5%;  
            bottom: 3px;  
            left: -12%;  
            border-radius: 50%;  
        }  

        .man .legs .one {  
            background: #ffaf72;  
            left: 20%;  
            z-index: 3;  
        }  
        
        .man .legs .two {  
            background: #f78d5c;  
            left: 10%;  
            z-index: 2;  
            transform: rotate(10deg);  
        }  

        .man .legs .thy {  
            background: #649740;  
            position: absolute;  
            height: 12%;  
            width: 120%;  
            left: 24%;  
            z-index: 2;  
        }  

        .man .legs .thy::after {  
            content: "";  
            position: absolute;  
            border-top-left-radius: 40%;  
            border-bottom-left-radius: 40%;  
            top: -70%;  
            height: 240%;  
            width: 25%;  
            right: -20%;  
            background-color: #649740;  
        }  

        .man .main-parts {  
            position: absolute;  
            left: 33%;  
            width: 40%;  
            height: 30%;  
            top: 15%;  
        }  

        .man .main-parts .upper {  
            background: #e75a46;  
            position: absolute;  
            height: 30%;  
            width: 48%;  
            bottom: 36%;  
            z-index: 1;  
            transform: rotate(-5deg);  
        }  

        .man .main-parts .lower {  
            position: absolute;  
            height: 40%;  
            width: 100%;  
            bottom: 0%;  
            background: #cf4444;  
            z-index: 2;  
        }  

        .man .main-parts .lower::after {  
            content: "";  
            position: absolute;  
            height: 201%;  
            width: 56%;  
            right: 0;  
            top: -99%;  
            border-radius: 100%;  
            background: #cf4444;  
        }  

        .man .hand {  
            position: absolute;  
            right: 28%;  
            height: 40%;  
            width: 9%;  
            border-radius: 20px;  
            background: #ffaf72;  
            z-index: 5;  
            top: 12%;  
            animation: animate-hand 2s infinite;  
        }  

        .man .weight {  
            position: absolute;  
            height: 30%;  
            width: 18%;  
            border-radius: 50%;  
            left: 57%;  
            top: -10%;  
            background: #e75a46;  
            z-index: 10;  
            animation: animate-hand 2s infinite;  
        }  

        .man .weight:after {  
            content: "";  
            background-color: #cf4444;  
            position: absolute;  
            width: 60%;  
            height: 60%;  
            border-radius: 50%;  
            top: 50%;  
            left: 50%;  
            transform: translate(-50%, -50%);  
        }  

        .man .weight:before {  
            content: "";  
            background-color: #5aada7;  
            position: absolute;  
            width: 20%;  
            height: 20%;  
            border-radius: 50%;  
            top: 50%;  
            left: 50%;  
            transform: translate(-50%, -50%);  
            z-index: 1;  
        }  

        @keyframes animate-hand {  
            50% {  
                transform: translateY(-40px);  
            }  
        }  

        .man .arm {  
            position: absolute;  
            right: 28%;  
            width: 10%;  
            height: 10%;  
            z-index: 5;  
            top: 88px;  
            background: #f78d5c;  
            border-radius: 30px 5px 5px 30px;  
        }  

        .man .neck {  
            position: absolute;  
            left: 73%;  
            width: 20%;  
            height: 12%;  
            background: #f78d5c;  
            top: 32%;  
            overflow: hidden;  
        }  

        .man .neck .head {  
            position: absolute;  
            right: 0;  
            bottom: -8%;  
            width: 69%;  
            height: 166%;  
            border-radius: 50%;  
            background: #ffaf72;  
        }  

        .man .nose {  
            width: 10%;  
            height: 10%;  
            position: absolute;  
            right: 5%;  
            top: 21%;  
            display: flex;  
            justify-content: space-evenly;  
        }  

        .man .nose div {  
            position: absolute;  
            bottom: -24%;  
            width: 7px;  
            height: 10px;  
            border-radius: 50%;  
            background: #ffaf72;  
        }  

        .man .nose div:nth-child(1) {  
            left: 10%;  
        }  

        .man .nose div:nth-child(2) {  
            left: 50%;  
        }  

        .man .hairs {  
            position: absolute;  
            left: 86%;  
            height: 20%;  
            width: 10%;  
            top: 23%;  
        }  

        .man .hairs .lower {  
            position: absolute;  
            bottom: -3px;  
            right: 11px;  
            width: 70%;  
            height: 33%;  
            background: #54303c;  
            border-radius: 4px;  
            border-bottom-right-radius: 20%;  
        }  

        .man .hairs .lower::after {  
            content: "";  
            position: absolute;  
            width: 24%;  
            height: 40%;  
            border-radius: 50%;  
            background: #ffaf72;  
        }  

        .man .hairs .upper {  
            position: absolute;  
            right: -10%;  
            bottom: 0;  
            height: 80%;  
            width: 40%;  
        }  

        .man .hairs .upper div {  
            position: absolute;  
            width: 100%;  
            height: 40%;  
            background: #54303c;  
            border-radius: 50%;  
        }  

        .bench-container {  
            position: absolute;  
            top: 60%;  
            left: 40%;  
            width: 45%;  
            height: 25%;  
            z-index: 2;  
        }  

        .bench-container .left {  
            position: absolute;  
            top: 10%;  
            left: 0;  
            background: #476199;  
            width: 5%;  
            height: 90%;  
        }  

        .bench-container .left::after {  
            content: "";  
            position: absolute;  
            width: 300%;  
            height: 10%;  
            left: -100%;  
            bottom: 0;  
            border-top: 4px solid #4a8197;  
            background: #476199;  
        }  

        .bench-container .right {  
            position: absolute;  
            top: -100%;  
            right: 5%;  
            background: #476199;  
            width: 5%;  
            height: 200%;  
        }  

        .bench-container .right::after {  
            content: "";  
            position: absolute;  
            width: 400%;  
            height: 5%;  
            left: -150%;  
            bottom: 0;  
            border-top: 4px solid #4a8197;  
            background: #476199;  
        }  

        .seat {  
            position: absolute;  
            width: 100%;  
            background: #4e9993;  
            height: 10%;  
            border-radius: 15px 15px 0 0;  
        }  

        .rod1 {  
            position: absolute;  
            top: 70%;  
            height: 15%;  
            width: 40%;  
            right: 5%;  
            z-index: 1;  
        }  
        
        /* Responsive styles */  
        @media (max-width: 768px) {  
            .container {  
                width: 70%; /* Increase width on smaller screens */  
                height: 60vh; /* Adjust height */   
            }  

            .man {  
                top: 25%; /* Make it a bit more centered vertically */  
                width: 70%; /* Increase width for better visibility */  
                height: 50%; /* Adjust the height */  
            }  
        }  

        @media (max-width: 480px) {  
            .man {  
                top: 20%; /* Adjust vertical positioning */  
                width: 80%; /* Increase width to fit smaller screens */  
                height: 60%; /* Adjust height */  
            }  

            .man .legs,  
            .man .main-parts {  
                width: 25%; /* Scale down width of legs and arms */  
            }  

            .man .hand,  
            .man .weight {  
                width: 12%; /* Adjust size of hand and weight */  
            }  
        }  
    </style>  
</head>  

<body onload="showLoader()">  
    <div class="container">  
        <div class="bench-container">  
            <div class="seat"></div>  
            <div class="left"></div>  
            <div class="right"></div>  
        </div>  
        <div class="man">  
            <div class="legs">  
                <div class="leg one"></div>  
                <div class="leg two"></div>  
                <div class="thy"></div>  
            </div>  
            <div class="main-parts">  
                <div class="lower"></div>  
                <div class="upper">  
                    <div class="above"></div>  
                </div>  
            </div>  
            <div class="neck">  
                <div class="head"></div>  
            </div>  
            <div class="arm"></div>  
            <div class="nose">  
                <div></div>  
                <div></div>  
            </div>  
            <div class="hairs">  
                <div class="lower"></div>  
                <div class="upper">  
                    <div></div>  
                    <div></div>  
                    <div></div>  
                </div>  
            </div>  
            <div class="hand"></div>  
            <div class="weight"></div>  
        </div>  
        <div class="rod1"></div>  
    </div>  

    <!-- Tabler JS -->  
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script> <!-- Include particles.js library -->  

    <script>  
        function showLoader() {  
            // Redirect after 5 seconds  
            setTimeout(function() {  
                window.location.href = 'BMI.php'; // Redirect to the next page  
            }, 2900);  
        }  
    </script>   
</body>  
</html>