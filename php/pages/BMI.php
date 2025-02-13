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
$explanation = '';  

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
    if ($lang === 'fa') {  
        if ($sex === 'male') {  
            if ($bmi < 17) {  
                return '<h4 class="lifestyle-warning-title"> هشدار سبک زندگی</h4> <p>کمبود وزن و BMI پایین خطرات خاص خود را دارد که شامل کمبود ویتامین، کم خونی، افسردگی، خشکی پوست، بیماری‌های قلبی-عروقی، ریزش مو، سیستم ایمنی ضعیف، پوکی استخوان، سوء تغذیه.</p>';  
            }  
        } elseif ($sex === 'female') {  
            if ($bmi < 17) {  
                return '<h4 class="lifestyle-warning-title"> هشدار سبک زندگی</h4> <p>کمبود وزن و BMI پایین خطرات خاص خود را دارد که شامل بیماری‌های قلبی-عروقی، افسردگی، ریزش مو، مشکل در باردار شدن، اختلالات قاعدگی، سیستم ایمنی ضعیف، پوکی استخوان، سوء تغذیه.</p>';  
            }  
        }  
        if ($bmi >= 25 && $bmi < 30) {  
            return '<h4 class="lifestyle-warning-title"> هشدار سبک زندگی</h4> <p>اضافه وزن تاثیرات منفی زیادی بر روی سلامتی دارد که شامل افزایش فشار خون، افزایش ریسک ابتلا به دیابت نوع دو، کاهش سطح کلسترول خوب خون و افزایش سطح کلسترول بد خون، افزایش کارایی قلب، و بالا رفتن خطر بیماری‌های قلبی.</p>';  
        }  
        if ($bmi >= 30) {  
            return '<h4 class="lifestyle-warning-title"> هشدار سبک زندگی</h4> <p>چاقی خطرات جدی برای سلامتی دارد که شامل افزایش فشار خون، ریسک بالای دیابت نوع دو، کاهش سطح کلسترول خوب خون و بالا رفتن سطح کلسترول بد خون، افزایش احتمال سکته‌ها، آرتروز و مشکلات تنفسی مانند آپنه خواب.</p>';  
        }  
    } else {  
        if ($sex === 'male') {  
            if ($bmi < 17) {  
                return '<h4 class="lifestyle-warning-title"> Lifestyle Warning</h4> <p>Being underweight and having a low BMI has specific risks, including vitamin deficiency, anemia, depression, dry skin, cardiovascular diseases, hair loss, weak immune system, osteoporosis, malnutrition.</p>';  
            }  
        } elseif ($sex === 'female') {  
            if ($bmi < 17) {  
                return '<h4 class="lifestyle-warning-title"> Lifestyle Warning</h4> <p>Being underweight and having a low BMI has specific risks, including cardiovascular diseases, depression, hair loss, difficulty getting pregnant, menstrual disorders, weak immune system, osteoporosis, malnutrition.</p>';  
            }  
        }  
        if ($bmi >= 25 && $bmi < 30) {  
            return '<h4 class="lifestyle-warning-title"> Lifestyle Warning</h4> <p>Being overweight has many negative health impacts, including increased blood pressure, increased risk of type 2 diabetes, reduced HDL cholesterol levels, increased LDL cholesterol levels, increased workload on the heart, increased risk of cardiovascular diseases.</p>';  
        }  
        if ($bmi >= 30) {  
            return '<h4 class="lifestyle-warning-title"> Lifestyle Warning</h4> <p>Obesity has many negative health impacts including increased blood pressure, increased risk of type 2 diabetes, reduced HDL cholesterol levels, increased LDL cholesterol levels, increased risk of various heart and brain attacks, sleep apnea and respiratory problems, increased risk of gallbladder disease, increased cancer risk.</p>';  
        }  
    }  

    return '';  
}  

if ($height > 0 && $weight > 0) {  
    $heightInMeters = $height / 100;  
    $bmi = $weight / ($heightInMeters * $heightInMeters);  
    $bmiCategory = $classify($bmi, $language);  

    // Check if BMI is between 17 and 25  
    if ($bmi < 17 || $bmi > 25) {  
        $explanation = getExplanation($bmi, $sex, $language);  
    }  
    
    $_SESSION['bmi'] = $bmi;  
}  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $_SESSION['weight'] = convertPersianNumbersToEnglish($_POST['weight']);  
    $_SESSION['height'] = convertPersianNumbersToEnglish($_POST['height']);  
    $_SESSION['sex'] = $_POST['sex'];  
    header('Location: BMI.php');  
    exit;  
}  
?>  

<!DOCTYPE html>  
<html lang="<?php echo $language; ?>">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo $language === 'en' ? 'BMI Result' : 'BMI نتیجه'; ?></title>  
    <link href="../../src/css/tabler.min.css" rel="stylesheet">  
    <link href="../../src/css/styles.css" rel="stylesheet">  

    <!-- Font Links -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Montserrat.ttf"> <!-- Montserrat -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Vazir.ttf"> <!-- Vazir, ensure the path is correct --> 

    <style>  
        body {  
            margin: 0;  
            padding: 0;  
            overflow: hidden;  
            display: flex;  
            flex-direction: column;  
            justify-content: center;  
            align-items: center;  
            height: 730px;  
            text-align: center;
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>;
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */   
        }  

        #particles-js {  
            position: absolute;  
            width: 100%;  
            height: 100%;  
            background: linear-gradient(45deg,rgb(14, 107, 189),rgb(118, 204, 213));  
        }  

        .content {  
            opacity: 0; /* Hidden initially */  
            transform: translateY(20px); /* Start slightly translated */  
            transition: opacity 0.5s ease-out, transform 0.5s ease-out; /* Smooth transition for opacity and position */  
            z-index: 1; /* Keep the content above particles */  
            padding: 0 20px; /* Padding for small screens */  
        }  

        .content.visible {  
            opacity: 1; /* Fully visible */  
            transform: translateY(0); /* Reset translation */  
        }  

        .result-container {  
            display: flex;  
            flex-direction: column; /* Stack items vertically on small screens */  
            justify-content: center;  
            align-items: center;  
            width: 100%;  
            max-width: 1200px;  
        }  

        .bmi-bubble {  
            display: flex;  
            flex-direction: column;  
            justify-content: center;  
            align-items: center;  
            padding: 20px;  
            border-radius: 80px;  
            background: rgba(11, 122, 233, 0.9);  
            color: white;  
            margin: 10px;  
            width: 90%; /* Responsive width */  
            max-width: 500px; /* Max width for larger screens */  
            box-sizing: border-box;
            font-size: 32px;
            opacity: 0.7;  
        }  

        .bmi-bubble-no-explanation {  
            display: flex;  
            flex-direction: column;  
            justify-content: center;  
            align-items: center;  
            padding: 20px;  
            border-radius: 80px;  
            background: rgba(11, 122, 233, 0.9); 
            opacity: 0.7; 
            color: white;  
            margin: 10px;  
            width: 90%; /* Responsive width */  
            max-width: 500px; /* Max width for larger screens */  
            box-sizing: border-box;
            font-size: 26px;   
        }  

        .bmi-status {  
            margin-top: 10px;  
            font-size: 1em; /* Responsive font size */  
        }  

        .explanation-bubble {  
            display: grid;  
            justify-content: center;  
            align-items: center;  
            padding: 20px;  
            border-radius: 80px;  
            background: rgba(242, 244, 246, 0.7);  
            color: #333;  
            margin: 10px;  
            border: 1px solid #ccc;  
            width: 90%; /* Responsive width */  
            max-width: 500px; /* Max width for larger screens */  
            box-sizing: border-box;  
        }  

        .btn-container {  
            margin-top: 20px;  
            z-index: 2; /* Ensure button is above particles */  
            position: relative; /* Position relative for z-index to work */
            flex-direction: column;  
            justify-content: center;  
        }  
        
        .btn {  
            width: 220px; /* Full width on mobile */  
            max-width: 220px; /* Set max width for larger screens */  
            padding: 10px; 
            background-color:rgb(222, 227, 233); 
            color: Navy;  
            border: none;  
            border-radius: 5px;  
            cursor: pointer;  
            font-size: 1em; /* Responsive font size */  
        }  

        .btn:hover {  
            color: white; 
            background-color: navy; 
        }  

        /* Lifestyle warning title CSS */  
        .lifestyle-warning-title {  
            color: red;  
            text-align: center;  
            margin: 0;  
            font-size: 1.5em; /* Responsive font size */  
            font-weight: bold;  
            padding-bottom: 10px;  
        }  

        /* Media Queries for responsiveness */  
        @media (max-width: 768px) {  
            .bmi-bubble, .bmi-bubble-no-explanation, .explanation-bubble {  
                padding: 15px; /* Reduce padding on smaller screens */  
            }  

            .bmi-status {  
                font-size: 0.9em; /* Smaller font size on mobile */  
            }  

            .btn {  
                font-size: 0.9em; /* Smaller button font size on mobile */  
            }  

            .lifestyle-warning-title {  
                font-size: 1.2em; /* Smaller title size on mobile */  
            }  
        }  

        @media (max-width: 480px) {  
            .bmi-bubble, .bmi-bubble-no-explanation, .explanation-bubble {  
                width: 95%; /* More width on extremely small screens */  
            }  
        }  
    </style>  
</head>  

<body>  
    <div id="particles-js"></div> <!-- Particles.js container -->  
    <div class="content">  
        <h1><?php echo $language === 'en' ? 'BMI Result' : 'نتیجه BMI'; ?></h1>  
        <div class="result-container">  
            <?php if ($bmi > 0): ?>  
                <div class="bmi-bubble <?php echo empty($explanation) ? 'bmi-bubble-no-explanation' : ''; ?>">  
                    <?php echo $language === 'en' ? 'Your BMI: ' . number_format($bmi, 2) : 'BMI شما: ' . number_format($bmi, 2); ?>  
                    <div class="bmi-status">  
                        <h2><?php echo $language === 'en' ? 'Status: ' . $bmiCategory : 'وضعیت: ' . $bmiCategory; ?></h2>  
                    </div>  
                </div>  

                <!-- Explanation box placement based on language -->  
                <?php if ($explanation): ?>  
                    <div class="explanation-bubble" style="order: <?php echo ($language === 'fa') ? '1' : '0'; ?>"><?php echo $explanation; ?></div>  
                <?php endif; ?>  
            <?php else: ?>  
                <h2><?php echo $language === 'en' ? 'Please enter your weight and height.' : 'لطفاً اطلاعات وزن و قد خود را وارد کنید.'; ?></h2>  
            <?php endif; ?>  
        </div>  
    </div>   

    <div class="btn-container">  
        <button onclick="window.location.href='body-type.php';" class="btn"><?php echo $language === 'en' ? 'Proceed' : 'ادامه'; ?></button>  
    </div>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>   
    <script>  
        // Initialize particles.js  
        particlesJS("particles-js", {  
            "particles": {  
                "number": {  
                    "value": 5,  
                    "density": {  
                        "enable": true,  
                        "value_area": 800  
                    }  
                },  
                "color": {  
                    "value": "#ffffff"  
                },  
                "shape": {  
                    "type": "circle",  
                    "stroke": {  
                        "width": 0,  
                        "color": "#000000"  
                    },  
                    "polygon": {  
                        "nb_sides": 6  
                    },  
                    "image": {  
                        "src": "img/github.svg",  
                        "width": 100,  
                        "height": 100  
                    }  
                },  
                "opacity": {  
                    "value": 0.1,  
                    "random": false,  
                    "anim": {  
                        "enable": false,  
                        "speed": 60,  
                        "opacity_min": 0.1,  
                        "sync": false  
                    }  
                },  
                "size": {  
                    "value": 100,  
                    "random": false,  
                    "anim": {  
                        "enable": true,  
                        "speed": 60,  
                        "size_min": 60,  
                        "sync": false  
                    }  
                },  
                "line_linked": {  
                    "enable": false,  
                    "distance": 150,  
                    "color": "#ffffff",  
                    "opacity": 0.4,  
                    "width": 1  
                },  
                "move": {  
                    "enable": true,  
                    "speed": 5,  
                    "direction": "none",  
                    "random": false,  
                    "straight": false,  
                    "out_mode": "out",  
                    "bounce": false,  
                    "attract": {  
                        "enable": false,  
                        "rotateX": 600,  
                        "rotateY": 1200  
                    }  
                }  
            },  
            "interactivity": {  
                "detect_on": "canvas",  
                "events": {  
                    "onhover": {  
                        "enable": false,  
                        "mode": "repulse"  
                    },  
                    "onclick": {  
                        "enable": false,  
                        "mode": "push"  
                    },  
                    "resize": true  
                },  
                "modes": {  
                    "grab": {  
                        "distance": 140,  
                        "line_linked": {  
                            "opacity": 1  
                        }  
                    },  
                    "bubble": {  
                        "distance": 400,  
                        "size": 40,  
                        "duration": 2,  
                        "opacity": 8,  
                        "speed": 3  
                    },  
                    "repulse": {  
                        "distance": 200,  
                        "duration": 0.4  
                    },  
                    "push": {  
                        "particles_nb": 4  
                    },  
                    "remove": {  
                        "particles_nb": 2  
                    }  
                }  
            },  
            "retina_detect": true  
        });  

        // Show content after the page has loaded  
        window.onload = function() {  
            const content = document.querySelector('.content');  
            content.classList.add('visible'); // Add the visible class after the window loads  
        };  
    </script>