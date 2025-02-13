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
<html lang="<?php echo $language; ?>">  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>  
        <?php echo $language === 'en' ? 'Suggestions' : 'پیشنهادات'; ?>  
    </title>  
    <link href="../../src/css/tabler.min.css" rel="stylesheet">  
    <link href="../../src/css/styles.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
        <!-- Font Links -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Montserrat.ttf"> <!-- Montserrat -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Vazir.ttf"> <!-- Vazir, ensure the path is correct -->  

    <style>  
        body {  
            text-align: <?php echo $language === 'fa' ? 'right' : 'center'; ?>;  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>;  
            padding: 20px;  
            position: relative;  
            overflow: hidden;  
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */ 
        }  

        #particles-js {  
            position: absolute;  
            width: 100%;  
            height: 100%;  
            background-color: #000;  
            background: linear-gradient(45deg, rgb(14, 107, 189), rgb(118, 204, 213));  
            z-index: 0;  
        }  

        .carousel-container {  
            width: 80%;  
            /* Responsive width */  
            max-width: 900px;  
            /* Maximum width */  
            margin: 50px auto;  
            /* Center the carousel */  
            position: relative;  
            /* Position relative for absolute positioning of controls */  
        }  

        .carousel {  
            background-color: rgba(0, 0, 0, 0.7);  
            /* Black background with 0.7 opacity */  
            z-index: 1;  
            position: relative;  
            border-radius: 10px;  
            /* Rounded corners */  
        }  

        .carousel-inner {  
            padding: 20px;  
        }  

        .carousel-item {  
            color: white;  
            /* Text color */  
            text-align: center;  
        }  

        .carousel-item h3 {  
            font-size: 2rem;  
            margin-bottom: 15px;  
        }  

        .carousel-item p {  
            font-size: 1.2rem;  
        }  

        .carousel-buttons {  
            display: flex;  
            justify-content: center;  
            margin-top: 20px;  
            flex-direction: <?php echo $language === 'fa' ? 'row-reverse' : 'row'; ?>;  
            /* Reverse button order for Persian */  
            flex-wrap: wrap;  
            /* Allow buttons to wrap to the next line on smaller screens */  
        }  

        .carousel-buttons button,  
        .homepage-button {  
            margin: 5px;  
            /* Space between buttons */  
            padding: 10px 15px;  
            font-size: 0.9rem;  
            /* Smaller font size */  
            cursor: pointer;  
            flex: 1 1 auto;  
            /* Distribute available space evenly */  
            min-width: 150px;  
            /* Minimum width for the button */  
        }  

        /* Style for the carousel controls */  
        .carousel-control-prev,  
        .carousel-control-next {  
            position: absolute;  
            top: 50%;  
            /* Vertically center the controls */  
            transform: translateY(-50%);  
            /* Adjust for true vertical centering */  
            font-size: 2rem;  
            /* Increase the size of the control icons */  
            color: white;  
            /* Set the color of the control icons */  
            cursor: pointer;  
            z-index: 2;  
            /* Ensure they're above the carousel */  
        }  

        .carousel-control-prev {  
            left: -50px;  
            /* Position to the left of the carousel */  
        }  

        .carousel-control-next {  
            right: -50px;  
            /* Position to the right of the carousel */  
        }  


        /* Media query for smaller screens */  
        @media (max-width: 576px) {  

            .carousel-control-prev {  
                left: -20px;  
                /* Position to the left of the carousel */  
            }  

            .carousel-control-next {  
                right: -20px;  
                /* Position to the right of the carousel */  
            }  

            .carousel-buttons button,  
            .homepage-button {  
                font-size: 0.8rem;  
                /* Even smaller font on very small screens */  
                padding: 8px 12px;  
                min-width: 120px;  
                /* Further reduce minimum width */  
            }  
        }  
    </style>  
</head>  

<body class="<?php echo $language; ?>">  
    <div id="particles-js"></div>  
    <div class="container">  
        <div class="carousel-container">  
            <div id="suggestionCarousel" class="carousel slide" data-ride="carousel">  
                <div class="carousel-inner">  
                    <div class="carousel-item active" id="firstSlide">  
                        <h3>  
                            <?php echo $language === 'en' ? 'Suggestions' : 'پیشنهادات'; ?>  
                        </h3>  
                        <p>  
                            <?php  
                            $suggestionText = $language === 'en' ?  
                                'Dear [Family Name], motivation must come from within to guide the athlete towards excellence. A proper body is one without excess weight and fat around the hips and abdomen. A muscular and strong body can be a sign of health. Using proper and balanced nutrition, considering daily energy expenditure, suitable exercises based on your age, height, and weight, along with adequate rest, is an appropriate solution.  
                            <br>  
                            Our team\'s suggestion for your weight loss:' :  
                                'عزیز (فامیل طرف)، انگیزش باید از درون به بیرون بیاید تا ورزشکار بتواند به سمت تعالی هدایت شود. بدنی متناسب است که بدون اضافه وزن و چربی اضافه در اطراف پهلو و شکم باشد. بدنی عضلانی و قوی می تواند نشانه ی سلامتی باشد. استفاده از تغدیه مناسب و متعادل با در نظر گرفتن انرژی مصرفی روزانه، تمرینات متناسب با سن، قد و وزن شما، همراه با استراحت کافی راه حلی مناسب می باشد.  
                            <br>  
                            پیشنهاد تیم (اسم گروه) برای کاهش وزن شما:';  
                            echo $suggestionText;  
                            ?>  
                        </p>  
                        <div class="carousel-buttons">  
                            <button>  
                                <?php  
                                if ($language === 'en') {  
                                    echo 'Change at a moderate rate (lose 1 kg per week)';  
                                } else {  
                                    echo 'تغییر با سرعت متوسط (کم کردن هفته ای ۱ کیلوگرم)';  
                                }  
                                ?>  
                            </button>  
                            <button>  
                                <?php  
                                if ($language === 'en') {  
                                    echo 'Change at a slow rate (lose 500g per week)';  
                                } else {  
                                    echo 'تغییر با سرعت کم (کم کردن هفته ای ۵۰۰ گرم)';  
                                }  
                                ?>  
                            </button>  
                        </div>  
                    </div>  
                    <div class="carousel-item" id="secondSlide">  
                        <h3>  
                            <?php echo $language === 'en' ? 'Additional Information' : 'توضیحات تکمیلی'; ?>  
                        </h3>  
                        <p>  
                            <?php  
                            if ($language === 'en') {  
                                echo "What you expect from conventional bodybuilding exercises is not mysterious. Rather, first correct your attitude towards your body for change, then use correct and verified exercises according to your body type. The right way of training and the right lifestyle will allow you to get the maximum result in the minimum time.";  
                            } else {  
                                echo "انچه شما از تمرینات مرسوم بدنسازی انتظار دارید اسرار امیز نیست . بلکه ابتدا برای تغییر ،  دیدگاه تان را نسبت به بدن خود اصلاح کنید سپس از تمرینات صحیح و بررسی شده با توجه به تیپ بدنی خودتان استفاده کنید . شیوه صحیح تمرین و سبک زندگی درست ، موجب میشود حداکثر نتیجه را در حداقل زمان کسب کنید .";  
                            }  
                            ?>  
                        </p>  
                        <button class="homepage-button" onclick="goToHomePage()">  
                            <?php echo $language === 'en' ? 'Proceed to homepage' : 'رفتن به صفحه اصلی'; ?>  
                        </button>  
                    </div>  
                </div>  
                <a class="carousel-control-prev" href="#suggestionCarousel" role="button" data-slide="prev">  
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>  
                    <span class="sr-only">  
                        <?php echo $language === 'en' ? 'Previous' : 'قبلی'; ?>  
                    </span>  
                </a>  
                <a class="carousel-control-next" href="#suggestionCarousel" role="button" data-slide="next">  
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>  
                    <span class="sr-only">  
                        <?php echo $language === 'en' ? 'Next' : 'بعدی'; ?>  
                    </span>  
                </a>  
            </div>  
        </div>  
    </div>  

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>  

    <script>  
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

        if ('serviceWorker' in navigator) {  
            window.addEventListener('load', () => {  
                navigator.serviceWorker.register('/service-worker.js')  
                    .then(registration => {  
                        console.log('Service Worker registered with scope:', registration.scope);  
                    })  
                    .catch(error => {  
                        console.error('Service Worker registration failed:', error);  
                    });  
            });  
        }  

        $(document).ready(function() {  
            function setSecondSlideHeight() {  
                var firstSlideHeight = $('#firstSlide').height();  
                $('#secondSlide').height(firstSlideHeight);  
            }  

            setSecondSlideHeight(); // Set height on page load  

            // Update height on window resize (optional)  
            $(window).resize(setSecondSlideHeight);  
        });  

        function goToHomePage() {  
            window.location.href = "home.php";  
        }  
    </script>  
</body>  

</html>