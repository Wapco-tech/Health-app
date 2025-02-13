const CACHE_NAME = 'health-app-cache-v1';  
const urlsToCache = [  
    '/',  
    '/health-app/php/pages/login.php', // Adjusted path to the login page  
    '/health-app/src/css/tabler.min.css', // Path to your Tabler CSS file  
    '/health-app/src/js/tabler.min.js',   // Path to your Tabler JS file  
    '/health-app/src/icons/icon-192x192.png', // Path to your 192x192 icon  
    '/health-app/src/icons/icon-512x512.png'  // Path to your 512x512 icon  
];  

// Install the service worker  
self.addEventListener('install', (event) => {  
    event.waitUntil(  
        caches.open(CACHE_NAME)  
            .then((cache) => {  
                return cache.addAll(urlsToCache);  
            })  
    );  
});  

// Fetch assets from cache  
self.addEventListener('fetch', (event) => {  
    event.respondWith(  
        caches.match(event.request)  
            .then((response) => {  
                return response || fetch(event.request);  
            })  
    );  
});