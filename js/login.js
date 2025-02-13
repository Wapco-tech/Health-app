// login.js  

// Language support  
const translations = {  
    en: {  
        title: "Sign in",  
        subtitle: "Welcome back to your favorite health app!",  
        username: "Enter your email",  
        password: "Enter your password",  
        login: "Sign in",  
        forgotPassword: "Forgot your password?",  
        signup: "Sign Up"  
    },  
    fa: {  
        title: "ورود",  
        subtitle: "به اپلیکیشن سلامت خود خوش آمدید!",  
        username: "نام کاربری",  
        password: "رمز عبور",  
        login: "ورود",  
        forgotPassword: "رمز عبور خود را فراموش کرده‌اید؟",  
        signup: "ثبت نام"  
    }  
};  

// Function to switch language  
function switchLanguage(lang) {  
    // Update the session language via fetch  
    fetch('../../php/pages/set_language.php?lang=' + lang) // Adjust path to set_language.php  
        .then(response => {  
            if (response.ok) {  
                // Reload the page to apply the new language  
                window.location.reload();  
            } else {  
                console.error('Failed to update language');  
            }  
        })  
        .catch(error => {  
            console.error('Error:', error);  
        });  
}  

// Function to dynamically update the UI without reloading (optional)  
function updateUI(lang) {  
    document.getElementById('login-title').innerText = translations[lang].title;  
    document.getElementById('login-subtitle').innerText = translations[lang].subtitle;  
    document.getElementById('username').placeholder = translations[lang].username;  
    document.getElementById('password').placeholder = translations[lang].password;  
    document.querySelector('button[type="submit"]').innerText = translations[lang].login;  
    document.querySelector('.forgot-password').innerText = translations[lang].forgotPassword;  
    document.querySelector('.signup-button').innerText = translations[lang].signup;  
}  

// Automatically update the UI based on the current language  
const currentLanguage = document.documentElement.lang; // Get the current language from the <html> tag  
updateUI(currentLanguage);