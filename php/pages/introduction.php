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
    <title><?php echo $language === 'en' ? 'Introduction - Health App' : 'معرفی - اپلیکیشن سلامت'; ?></title>  

    <!-- Tabler CSS -->  
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">  

    <!-- Font Links -->  
    <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Montserrat.ttf"> <!-- Montserrat -->  
    <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Vazir.ttf"> <!-- Vazir, ensure the path is correct -->  

    <style>  
        body {  
            display: block; /* Override the flexbox centering */  
            justify-content: unset; /* Remove centering */  
            align-items: unset; /* Remove centering */  
            height: auto; /* Allow the page to grow vertically */  
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */  
        }  

        .page {  
            width: 100%; /* Use the full width of the screen */  
            height: 100vh; /* Use the full height of the screen */  
            display: flex;  
            flex-direction: column;  
            justify-content: center;  
            align-items: center;  
        }  

        .carousel-item {  
            height: 100vh; /* Make the carousel take up the full height of the screen */  
            background-size: cover; /* Ensure the image covers the entire area */  
            background-position: center; /* Center the image */  
        }  

        .container {  
            max-width: 100%; /* Allow the container to use the full width */  
            padding: 0; /* Remove padding */  
        }  

        .card {  
            border: none; /* Remove the card border */  
            border-radius: 0; /* Remove the card border radius */  
            box-shadow: none; /* Remove the card shadow */  
        }  

        .carousel-caption {  
            position: absolute; /* Positioning the caption absolutely within the carousel */  
            top: 50%; /* Center vertically */  
            left: 50%; /* Center horizontally */  
            transform: translate(-50%, -50%); /* Adjust positioning to truly center */  
            background: rgba(0, 0, 0, 0.8); /* Semi-transparent background for captions */  
            color: white;  
            padding: 20px;  
            border-radius: 10px;  
            text-align: center; /* Center text within the caption */  
            max-width: 900px; /* Limit maximum width */   
            width: 90%; /* Make the caption responsive */  
            height: auto;   
            max-height: 300px;   
            height: auto; /* Height adjusted to content */  
        }  

        .carousel-caption h1 {  
            font-size: 32px;  
            margin-bottom: 5px;  
        }  

        .carousel-caption p {  
            font-size: 24px;  
            margin-top: 40px;   
            margin-bottom: 15px; /* Space for button to avoid interference */  
        }  

        .carousel-caption .button-container {  
            display: flex; /* Use flexbox for button and indicators */  
            flex-direction: column; /* Stack items vertically */  
            align-items: center; /* Center items horizontally */  
        }  

        .carousel-caption .btn {  
            padding: 10px 20px; /* Control padding */  
            margin-top: 10px;   
            margin-bottom: 10px; /* Space under button */  
            box-sizing: border-box; /* Include padding in width */  
            display: inline-block; /* Ensure button is treated as inline block */  
        }  

        .carousel-indicators {  
            margin-top: 10px; /* Space above the indicators */  
        }  

        /* Responsive Design */  
        @media (max-width: 768px) {  
            .carousel-caption h1 {  
                font-size: 20px;  
            }  

            .carousel-caption p {  
                font-size: 14px;  
                margin-top: 60px;   
                margin-bottom: 15px; /* Space for button to avoid interference */  
            }  

            .carousel-caption .btn {  
                font-size: 14px; /* Adjust button size */  
                padding: 10px 15px; /* Adjust padding */  
            }  
        }  

        @media (max-width: 480px) {  
            .carousel-caption h1 {  
                font-size: 18px;  
            }  

            .carousel-caption p {  
                font-size: 12px;  
            }  

            .carousel-caption .btn {  
                font-size: 12px; /* Adjust button size */  
                padding: 8px 12px; /* Adjust padding */  
            }  
        }  
    </style>  
</head>  

<body>  
    <div class="page">  
        <div class="container">  
            <div class="card">  
                <div id="carousel-example" class="carousel slide" data-bs-ride="carousel">  
                    <!-- Slides -->  
                    <div class="carousel-inner">  
                        <!-- Slide 1 -->  
                        <div class="carousel-item active" style="background-image: url('../../src/img/slide1.png');">  
                            <div class="carousel-caption">  
                                <h1><?php echo $language === 'en' ? 'In the Name of God' : 'بنام خداوند جان و خرد'; ?></h1>  
                                <p>  
                                    <?php echo $language === 'en'  
                                        ? 'Using this app helps individuals evaluate their abilities and improve themselves without external judgment. This is crucial for personal growth and should be encouraged.'  
                                        : 'استفاده از (اسم نرم افزار) کمک می کند که افراد بتوانند بدون حضور دیگران به قضاوت در مورد لیاقت و توانایی های خودشان بپردازند و امکان رشد فردی و افزایش توانایی ها تا حد کمال مطلوب را برای خود فراهم کنند و این حالت بسیار با اهمیت است و باید توسعه یابد'; ?>  
                                </p>  
                                <div class="button-container">  
                                    <div class="carousel-indicators">  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="0" class="active"  
                                            aria-current="true" aria-label="Slide 1"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="1"  
                                            aria-label="Slide 2"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="2"  
                                            aria-label="Slide 3"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="3"  
                                            aria-label="Slide 4"></button>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  

                        <!-- Slide 2 -->  
                        <div class="carousel-item" style="background-image: url('../../src/img/slide2.png');">  
                            <div class="carousel-caption">  
                                <h1><?php echo $language === 'en' ? 'Artificial Intelligence' : 'هوش مصنوعی'; ?></h1>  
                                <p>  
                                    <?php echo $language === 'en'  
                                        ? 'Artificial Intelligence (AI) is a technology that mimics human thinking. Combining AI with expertise reduces errors and personalizes training programs, improving performance and health.'  
                                        : ' هوش مصنوعی در واقع تکنولوژی ای است که به نحوی قابلیت تفکر دارد ، تلفیق تخصص و مهارت گروه ( اسم کارگروه نرم افزار ) با هوش مصنوعی موجب کاهش ضریب خطا و درک صحیح تری از شرایط تمرینی شما خواهد شد'; ?>  
                                </p>  
                                <div class="button-container">  
                                    <div class="carousel-indicators">  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="0"  
                                            aria-label="Slide 1"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="1"  
                                            class="active" aria-current="true" aria-label="Slide 2"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="2"  
                                            aria-label="Slide 3"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="3"  
                                            aria-label="Slide 4"></button>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  

                        <!-- Slide 3 -->  
                        <div class="carousel-item" style="background-image: url('../../src/img/slide3.png');">  
                            <div class="carousel-caption">  
                                <h1><?php echo $language === 'en' ? 'Start Your Fitness Journey' : 'شروع ورزش'; ?></h1>  
                                <p>  
                                    <?php echo $language === 'en'  
                                        ? 'The key to fitness is self-awareness, goal-setting, and knowledge. Regular exercise is one of the best things you can do for your health. If you don’t know where to start, we can help you create a plan.'  
                                        : 'کلید شروع ورزش ، خودآگاهی -انتخاب هدف -دانش روز است . یکی از بهترین کارهایی که می توانید برای حفظ سلامتی خود انجام دهید ، ورزش منظم است'; ?>  
                                </p>  
                                <div class="button-container">  
                                    <div class="carousel-indicators">  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="0"  
                                            aria-label="Slide 1"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="1"  
                                            aria-label="Slide 2"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="2"  
                                            class="active" aria-current="true" aria-label="Slide 3"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="3"  
                                            aria-label="Slide 4"></button>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  

                        <!-- Slide 4 -->  
                        <div class="carousel-item" style="background-image: url('../../src/img/slide4.png');">  
                            <div class="carousel-caption">  
                                <h1><?php echo $language === 'en' ? 'Join Us' : 'به ما بپیوندید'; ?></h1>  
                                <p>  
                                    <?php echo $language === 'en'  
                                        ? 'If you are passionate about fitness and AI, take the first step into this exciting world with us today.'  
                                        : 'اگر شما هم جزو علاقه مندان به ورزش و هوش مصنوعی هستید ، از همین حالا می توانید قدم اول برای ورود به این دنیای شگفت انگیز را همراه با ما بردارید'; ?>  
                                </p>  
                                <a href="personal-data.php" class="btn btn-primary">  
                                    <?php echo $language === 'en' ? 'Get Started' : 'شروع کنید'; ?>  
                                </a>  
                                <div class="button-container">  
                                    <div class="carousel-indicators">  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="0"  
                                            aria-label="Slide 1"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="1"  
                                            aria-label="Slide 2"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="2"  
                                            aria-label="Slide 3"></button>  
                                        <button type="button" data-bs-target="#carousel-example" data-bs-slide-to="3"  
                                            class="active" aria-current="true" aria-label="Slide 4"></button>  
                                    </div>  
                                </div>  
                            </div>  
                        </div>  
                    </div>  

                    <!-- Controls -->  
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-example"  
                        data-bs-slide="prev">  
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>  
                        <span class="visually-hidden">Previous</span>  
                    </button>  
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-example"  
                        data-bs-slide="next">  
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>  
                        <span class="visually-hidden">Next</span>  
                    </button>  
                </div>  
            </div>  
        </div>  
    </div>  

    <!-- Tabler JS -->  
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>  
    <!-- Bootstrap JS (required for carousel) -->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
</body>  

</html>