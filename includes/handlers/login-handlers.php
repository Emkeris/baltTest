<?php 

    if(isset($_POST['loginButton'])) {
        // Login Button was pressed
        $loginUsername = $_POST['loginUsername'];
        $loginPassword = $_POST['loginPassword'];

        $result = $account->login($loginUsername, $loginPassword);

        if($result) {
            $_SESSION['userLoggedIn'] = $loginUsername;
            header("Location: index.php");
        }
    }

?>