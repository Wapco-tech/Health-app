<?php  
session_start(); // Start the session  

if (isset($_GET['lang'])) {  
    $_SESSION['language'] = $_GET['lang']; // Set the language in the session  
}  
?>  