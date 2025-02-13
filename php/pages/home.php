<?php
session_start();

if (isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
} else {
    $language = 'fa'; // Default to English if no session value is set  
}
?>
<!DOCTYPE html>
<html lang="<?php echo $language; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language === 'en' ? 'Home - Health App' : 'خانه - اپلیکیشن سلامت'; ?></title>
    <link href="../../src/css/tabler.min.css" rel="stylesheet">
    <link href="../../src/css/styles.css" rel="stylesheet">
        <!-- Font Links -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Montserrat.ttf"> <!-- Montserrat -->  
        <link rel="stylesheet" href="//localhost/health-app/src/css/fonts/Vazir.ttf"> <!-- Vazir, ensure the path is correct --> 

    <style>
        /* General styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background: linear-gradient(to bottom, #ffffff, #86d9f2);
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 200px;
            height: auto;
            background: linear-gradient(135deg, #4a4e69, #22223b);
            /* Gradient background */
            color: #ffffff;
            display: flex;
            flex-direction: column;
            padding: 10px;
            border-radius: 10px;
            /* Soft edges */
            box-shadow: -2px 0 15px rgba(0, 0, 0, 0.3);
            /* Enhanced shadow */
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link {
            color: #ffffff;
            /* Link color */
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            /* Add transform for a slight scale effect */
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            /* Change background on hover */
            transform: scale(1.05);
            /* Slightly enlarge the link */
        }

        .sidebar .nav-link img {
            border-radius: 50%;
            /* Circular background for icons */
            background-color: rgba(255, 255, 255, 0.2);
            /* Light background for contrast */
            padding: 5px;
            /* Padding around the icon */
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar .nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .nav-item {
            margin-bottom: 15px;
        }

        .sidebar .nav-link {
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        .sidebar .nav-link svg {
            margin-right: 10px;
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .icon-white {
            filter: brightness(0) invert(1);
            /* This will turn the icon white */
        }

        .toggle-sidebar {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Bottom navigation styles */
        .bottom-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .bottom-menu a {
            text-decoration: none;
            color: #495057;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 12px;
            transition: color 0.3s ease;
        }

        .bottom-menu a:hover {
            color: #007bff;
        }

        .bottom-menu a span {
            display: none;
        }

        .bottom-menu a:hover span {
            display: block;
            font-size: 10px;
            margin-top: 5px;
        }

        @media (hover: hover) and (pointer: fine) {
            .bottom-menu a:hover span {
                display: block;
                font-size: 10px;
                margin-top: 5px;
            }
        }

        /* Show labels on touch for mobile/PWA */
        @media (hover: none) and (pointer: coarse) {

            .bottom-menu a:active span,
            /* When tapped */
            .bottom-menu a.touched span {
                /* Persistent state after touch */
                display: block;
                font-size: 10px;
                margin-top: 5px;
            }
        }
    </style>
</head>

<body>
    <!-- Toggle Sidebar Button -->
    <button class="toggle-sidebar" onclick="toggleSidebar()">☰</button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2><?php echo $language === 'en' ? 'Menu' : 'منو'; ?></h2>
        <ul class="nav">
            <li class="nav-item">
                <a href="profile.php" class="nav-link">
                    <img src="<?php echo '../../src/css/icons/icons/outline/user.svg'; ?>" alt="Profile Icon" width="24"
                        height="24" class="icon-white">
                    <?php echo $language === 'en' ? 'Profile' : 'پروفایل'; ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="personal_data.php" class="nav-link">
                    <img src="<?php echo '../../src/css/icons/icons/outline/id.svg'; ?>" alt="Personal Data Icon"
                        width="24" height="24" class="icon-white">
                    <?php echo $language === 'en' ? 'Personal Data' : 'اطلاعات شخصی'; ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="settings.php" class="nav-link">
                    <img src="<?php echo '../../src/css/icons/icons/outline/Settings.svg'; ?>" alt="Settings Icon"
                        width="24" height="24" class="icon-white">
                    <?php echo $language === 'en' ? 'Settings' : 'تنظیمات'; ?>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h3><?php echo $language === 'en' ? 'Progress Summary' : 'خلاصه پیشرفت'; ?></h3>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-menu">
        <a href="home.php">
            <img src="<?php echo '../../src/css/icons/icons/outline/home.svg'; ?>" alt="Diet Plan Icon" width="24"
                height="24">
            <span><?php echo $language === 'en' ? 'Home' : 'خانه'; ?></span>
        </a>
        <a href="diet_plan.php">
            <img src="<?php echo '../../src/css/icons/icons/outline/tools-kitchen-3.svg'; ?>" alt="Diet Plan Icon"
                width="24" height="24">
            <span><?php echo $language === 'en' ? 'Diet Plan' : 'برنامه غذایی'; ?></span>
        </a>
        <a href="workout_plan.php">
            <img src="<?php echo '../../src/css/icons/icons/outline/run.svg'; ?>" alt="Workout Plan Icon" width="24"
                height="24">
            <span><?php echo $language === 'en' ? 'Workout Plan' : 'برنامه ورزشی'; ?></span>
        </a>
        <a href="progress.php">
            <img src="<?php echo '../../src/css/icons/icons/outline/trending-up.svg'; ?>" alt="Progress Icon" width="24"
                height="24">
            <span><?php echo $language === 'en' ? 'Progress' : 'پیشرفت'; ?></span>
        </a>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // JavaScript for touch-based label display  
        const bottomLinks = document.querySelectorAll('.bottom-menu a');
        bottomLinks.forEach(link => {
            link.addEventListener('touchstart', () => {
                link.classList.add('touched');
            });
            link.addEventListener('touchend', () => {
                setTimeout(() => { // Small delay for better UX  
                    link.classList.remove('touched');
                }, 200);
            });
        });  
    </script>
</body>

</html>