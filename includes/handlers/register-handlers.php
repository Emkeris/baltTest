<?php 

function sanitizePassword($data) {
    $data = strip_tags($data);
    return $data;
}

function sanitizeUserName($data) {
    $data = strip_tags($data);
    $data = str_replace(" ", "", $data);
    return $data;
}

function sanitizeString($data) {
    $data = strip_tags($data);
    $data = str_replace(" ", "", $data);
    $data = ucfirst(strtolower($data));
    return $data;
}


if(isset($_POST['registerButton'])) {
    // Register button was pressed!
    $registerUsername = sanitizeUserName($_POST['registerUsername']);
    $registerName = sanitizeString($_POST['registerName']);
    $registerLastname = sanitizeString($_POST['registerLastname']);
    $registerEmail = sanitizeString($_POST['registerEmail']);
    $registerEmail2 = sanitizeString($_POST['registerEmail2']);
    $registerPassword = sanitizePassword($_POST['registerPassword']);
    $registerPassword2 = sanitizePassword($_POST['registerPassword2']);

    $wasSuccesfull = $account->register($registerUsername, $registerName, $registerLastname, $registerEmail, $registerEmail2, $registerPassword, $registerPassword2); 
    if($wasSuccesfull) {
        echo "<span class='regMessageSuccess'>Dekojame kad pas mus uzsiregistravote</span>";
    }
}

?>