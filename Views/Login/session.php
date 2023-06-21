<?php

// Filename: sessionHandler.php
// Purpose: To handle login information and create a session for that user

// Start session
session_start();

// Validation error flag
$errflag = false;

// Input validations
if ($_POST['email'] == '') {
    $errmsg_arr[] = 'Login email is missing';
    $errflag = true;
}

if ($_POST['password'] == '') {
    $errmsg_arr[] = 'Password is missing';
    $errflag = true;
}

// If input validation occured, redirect back to the login form
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: login.php");
    exit();
}

// Connect to MySQL server
$mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database named "fkedusearch"
mysqli_select_db($mysql, "fkedusearch") or die(mysqli_connect_error());

// Write SQL statement that selects the record from table named "users"
$email = $_POST['email'];
$pass = $_POST['password'];
$query = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";

// To run SQL query in database
$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));

// Check whether the query was successful or not
if (isset($result)) {
    if (mysqli_num_rows($result) == 1) {
        //Login-Successful
        session_regenerate_id();
        $member = mysqli_fetch_assoc($result);
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_NAME'] = $member['first_name'];
        $_SESSION['STATUS'] = true;
        session_write_close();
        header("location: profile.php");
        exit();
    } else {
        //Login failed
        header("location: login-failed.php");
        exit();
    }
} else {
    die("Query failed");
}