<?php  
session_start(); // Start the session  

// Check if a language is set in the session; otherwise, default to Persian  
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
    <title><?php echo $language === 'en' ? 'Personal Data - Health App' : 'اطلاعات شخصی - اپلیکیشن سلامت'; ?></title>  
    <link href="../../src/css/tabler.min.css" rel="stylesheet"> <!-- Adjust path as needed -->  
    <link href="../../src/css/styles.css" rel="stylesheet"> <!-- Link to your custom CSS -->  

    <!-- Include jQuery -->  
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>  

    <!-- Include Persian Datepicker -->  
    <script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">  

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
            text-align: <?php echo $language === 'fa' ? 'right' : 'center'; ?>;  
            direction: <?php echo $language === 'fa' ? 'rtl' : 'ltr'; ?>;  
            font-family: <?php echo $language === 'en' ? "'Montserrat', sans-serif" : "'Vazir', sans-serif"; ?>; /* Set font based on language */  
        }   

        .error-message {  
            color: red;  
            margin-top: 5px;  
            display: none;  
            font-size: 0.9em;  
        }  

        .input-container {  
            position: relative;  
        }  

        .error-message {  
            position: absolute;  
            bottom: -20px; /* Adjust to position below the input field */  
            <?php echo $language === 'fa' ? 'right: 0;' : 'left: 0;'; ?>  
        }  

        .text-center {  
            margin-top: 50px;  
        }  

        .btn-primary {  
            margin-top: 30px;  
        }  

        .logo {  
            margin-left: 20px;  
            width: 100px;  
            height: 100px;  
        }  
    </style>  

    <script>  
        function convertPersianNumbersToEnglish(input) {  
            const persianToEnglish = {  
                '۰': '0',  
                '۱': '1',  
                '۲': '2',  
                '۳': '3',  
                '۴': '4',  
                '۵': '5',  
                '۶': '6',  
                '۷': '7',  
                '۸': '8',  
                '۹': '9'  
            };  
            return input.replace(/[۰-۹]/g, char => persianToEnglish[char]);  
        }  

        function jalali_to_gregorian(jy, jm, jd) {  
            let gy = (jy > 979) ? 1600 : 621;  
            jy -= (jy > 979) ? 979 : 0;  
            let days = (365 * jy) + Math.floor(jy / 33) * 8 + Math.floor((jy % 33 + 3) / 4) + 78 + jd + ((jm < 7) ? (jm - 1) * 31 : ((jm - 7) * 30) + 186);  
            gy += Math.floor(days / 146097) * 400;  
            days %= 146097;  
            if (days > 36524) {  
                gy += Math.floor(--days / 36524) * 100;  
                days %= 36524;  
                if (days >= 365) days++;  
            }  
            gy += Math.floor(days / 1461) * 4;  
            days %= 1461;  
            gy += Math.floor((days - 1) / 365);  
            days = (days > 0) ? (days - 1) % 365 : 0;  
            let gm = (days < 186) ? 1 + Math.floor(days / 31) : 7 + Math.floor((days - 186) / 30);  
            let gd = 1 + ((days < 186) ? (days % 31) : ((days - 186) % 30));  
            return [gy, gm, gd];  
        }  

        function validateDateFormat(dateString) {  
            // Check if the date string matches the format YYYY/MM/DD  
            const regex = /^\d{4}\/\d{1,2}\/\d{1,2}$/;  
            return regex.test(dateString);  
        }  

        function calculateAge(dob, isPersian) {  
            let birthDate;  

            if (isPersian) {  
                dob = convertPersianNumbersToEnglish(dob); // Convert Persian numbers to English  

                // Validate the Jalali date format  
                if (!validateDateFormat(dob)) {  
                    console.error("Invalid date format. Expected format: YYYY/MM/DD");  
                    return NaN; // Return NaN to indicate an error  
                }  

                const jalaliDate = dob.split('/').map(Number);  
                if (jalaliDate.some(isNaN)) {  
                    console.error("Invalid Jalali date values");  
                    return NaN; // Return NaN to indicate an error  
                }  

                const gregorianDate = jalali_to_gregorian(jalaliDate[0], jalaliDate[1], jalaliDate[2]);  
                birthDate = new Date(gregorianDate[0], gregorianDate[1] - 1, gregorianDate[2]);  
            } else {  
                // Expecting a date in YYYY-MM-DD format for the HTML input type="date"  
                birthDate = new Date(dob);  
            }  

            const currentDate = new Date();  
            let age = currentDate.getFullYear() - birthDate.getFullYear();  
            const monthDiff = currentDate.getMonth() - birthDate.getMonth();  
            if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < birthDate.getDate())) {  
                age--;  
            }  

            return age;  
        }  

        function validateForm() {  
            const dob = document.querySelector('input[name="dob"]');   
            const sex = document.querySelector('select[name="sex"]');  
            const weight = document.querySelector('input[name="weight"]');  
            const height = document.querySelector('input[name="height"]');  

            // Clear any previous error messages  
            document.querySelectorAll('.error-message').forEach(error => {  
                error.textContent = '';  
                error.style.display = 'none';  
            });  

            let isValid = true;   

            if (!dob.value) {  
                document.getElementById('dob-error').textContent = '<?php echo $language === 'en' ? "Date of birth is required." : "تاریخ تولد الزامی است."; ?>';  
                document.getElementById('dob-error').style.display = 'block';  
                isValid = false;  
            }  
            if (!sex.value) {  
                document.getElementById('sex-error').textContent = '<?php echo $language === 'en' ? "Sex is required." : "جنسیت الزامی است."; ?>';  
                document.getElementById('sex-error').style.display = 'block';  
                isValid = false;  
            }  
            if (!weight.value) {  
                document.getElementById('weight-error').textContent = '<?php echo $language === 'en' ? "Weight is required." : "وزن الزامی است."; ?>';  
                document.getElementById('weight-error').style.display = 'block';  
                isValid = false;  
            }  
            if (!height.value) {  
                document.getElementById('height-error').textContent = '<?php echo $language === 'en' ? "Height is required." : "قد الزامی است."; ?>';  
                document.getElementById('height-error').style.display = 'block';  
                isValid = false;  
            }  

            if (isValid) {  
                let isPersian = (<?php echo $language === 'fa' ? 'true' : 'false'; ?>);  
                let age = calculateAge(dob.value, isPersian);  

                if (isNaN(age)) {  
                    document.getElementById('dob-error').textContent = '<?php echo $language === 'en' ? "Invalid date format." : "فرمت تاریخ نامعتبر است."; ?>';  
                    document.getElementById('dob-error').style.display = 'block';  
                    return false; // Prevent form submission  
                }  

                document.getElementById('personalDataForm').action = age < 17 ? 'body-type.php' : 'LOADER2.php';  
            }  
            return isValid;   
        }  
    </script>  
</head>  

<body>  
    <div class="login-container">  
        <form id="personalDataForm" method="POST" onsubmit="return validateForm();" autocomplete="off" novalidate>   
        <img src="../../src/img/logo.png" alt="Health App Logo" class="logo">   
            <h1>  
                <?php echo $language === 'en' ? 'Personal Data' : 'اطلاعات شخصی'; ?>  
            </h1>  
            <p>  
                <?php echo $language === 'en'  
                    ? 'Please enter your personal data to continue.'  
                    : 'لطفاً اطلاعات شخصی خود را وارد کنید.'; ?>  
            </p>  

            <!-- Date of Birth Input -->  
            <div class="input-container">  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Date of Birth' : 'تاریخ تولد'; ?> <span style="color: red;">*</span>  
                </label>  
                <?php if ($language === 'fa'): ?>  
                    <input type="text" id="dob" name="dob" class="form-control"  
                        placeholder="تاریخ تولد خود را وارد کنید (YYYY/MM/DD)" required>  
                <?php else: ?>  
                    <input type="date" id="dob" name="dob" class="form-control"  
                        required>  
                <?php endif; ?>  
                <div id="dob-error" class="error-message"></div>  
            </div>  

            <!-- Sex Input -->  
            <div class="input-container">  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Sex' : 'جنسیت'; ?> <span style="color: red;">*</span>  
                </label>  
                <select id="sex" name="sex" class="form-control" required>  
                    <option value=""><?php echo $language === 'en' ? 'Select your sex' : 'جنسیت خود را انتخاب کنید'; ?></option>  
                    <option value="male"><?php echo $language === 'en' ? 'Male' : 'مرد'; ?></option>  
                    <option value="female"><?php echo $language === 'en' ? 'Female' : 'زن'; ?></option>  
                </select>  
                <div id="sex-error" class="error-message"></div>  
            </div>  

            <!-- Weight Input -->  
            <div class="input-container">  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Weight (kg)' : 'وزن (کیلوگرم)'; ?> <span style="color: red;">*</span>  
                </label>  
                <input type="number" id="weight" name="weight" class="form-control"  
                    placeholder="<?php echo $language === 'en' ? 'Enter your weight (kg)' : 'وزن خود را وارد کنید (کیلوگرم)'; ?>"  
                    min="0" max="300" required>  
                <div id="weight-error" class="error-message"></div>  
            </div>  

            <!-- Height Input -->  
            <div class="input-container">  
                <label class="form-label">  
                    <?php echo $language === 'en' ? 'Height (cm)' : 'قد (سانتی‌متر)'; ?> <span style="color: red;">*</span>  
                </label>  
                <input type="number" id="height" name="height" class="form-control"  
                    placeholder="<?php echo $language === 'en' ? 'Enter your height (cm)' : 'قد خود را وارد کنید (سانتی‌متر)'; ?>"  
                    min="0" max="250" required>  
                <div id="height-error" class="error-message"></div>  
            </div>  

            <!-- Submit Button -->  
            <button type="submit" class="btn-primary">  
                <?php echo $language === 'en' ? 'Submit Data' : 'ارسال اطلاعات'; ?>  
            </button>  
        </form>  
    </div>  

    <?php if ($language === 'fa'): ?>  
        <script>  
            // Initialize Persian Date Picker  
            $(document).ready(function () {  
                $('#dob').persianDatepicker({  
                    format: 'YYYY/MM/DD', // Ensure this matches your expected format  
                    initialValue: false,  
                    autoClose: true,  
                });  
            });  
        </script>  
    <?php endif; ?>  
</body>  

</html>