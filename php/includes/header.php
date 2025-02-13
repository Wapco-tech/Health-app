<!DOCTYPE html>  
<html lang="<?php echo isset($_SESSION['language']) ? $_SESSION['language'] : 'fa'; ?>"> <!-- Set language dynamically -->  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Health App'; ?></title> <!-- Use a variable for the title -->  
    <!-- Tabler CSS -->  
    <link href="/health-app/src/static/css/tabler.min.css" rel="stylesheet">  
    <link href="/health-app/src/static/css/tabler-flags.min.css" rel="stylesheet">  
    <link href="/health-app/src/static/css/tabler-payments.min.css" rel="stylesheet">  
    <link href="/health-app/src/static/css/tabler-vendors.min.css" rel="stylesheet">  
    <link href="/health-app/src/static/css/demo.min.css" rel="stylesheet">  
    <style>  
        body {  
            text-align: <?php echo isset($_SESSION['language']) && $_SESSION['language'] === 'fa' ? 'right' : 'center'; ?>; /* Align text based on language */  
        }  
    </style>  
</head>  
<body>  
    <div class="page">  
    <link rel="manifest" href="/health-app/manifest.json">  
    <script>  
        if ('serviceWorker' in navigator) {  
            window.addEventListener('load', () => {  
                navigator.serviceWorker.register('/health-app/service-worker.js')  
                    .then((registration) => {  
                        console.log('Service Worker registered with scope:', registration.scope);  
                    })  
                    .catch((error) => {  
                        console.error('Service Worker registration failed:', error);  
                    });  
            });  
        }  
    </script>