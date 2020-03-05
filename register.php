<?php 
    @include 'includes/config.php';
    @include 'includes/classes/Account.php';
    @include 'includes/classes/Constants.php';

    $account = new Account($con);
    
    @include 'includes/handlers/register-handlers.php';
    @include 'includes/handlers/login-handlers.php';

    function getInputVal($data){
        if(isset($_POST[$data])) {
            echo $_POST[$data];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Register</title>
</head>
<body>


<div id="inputContainer" class="container mt-5">
    <form id="loginForm" action="register.php" method="POST">
    <h2 class="text-center">Login to your account</h2>
        <div class="row">
            <div class="col">
                <?php echo $account->getError(Constants::$loginFail) ?>
                <label for="loginUsername">Username</label>
                <input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Your Username" required>
            </div>
            <div class="col">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Your Password" required>
            </div>
        </div>
        <button class="loginButton btn btn-primary mt-3" type="submit" name="loginButton">Log in</button>
    </form>

    <hr>
    <form id="registerForm" action="register.php" method="POST">
    <h2 class="text-center">Register your account</h2>
    <div class="row">
        <div class="col">
            <?php echo $account->getError(Constants::$usernameShortLong) ?>
            <?php echo $account->getError(Constants::$usernameTaken) ?>
            <label for="registerUsername">Your Username</label>
            <input type="text" id="registerUsername" class="form-control" name="registerUsername" placeholder="e.g. Bart512" value="<?php getInputVal('registerUsername') ?>" required> 
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php echo $account->getError(Constants::$firstnameShortLong) ?>
            <label for="registerName">Your Name</label>
            <input type="text" id="registerName" class="form-control" name="registerName" placeholder="e.g. Bartas" value="<?php getInputVal('registerName') ?>" required>
        </div>
        <div class="col">
        <?php echo $account->getError(Constants::$lastnameShortLong) ?>
            <label for="registerLastname">Your Lastname</label>
            <input type="text" class="form-control" id="registerLastname" name="registerLastname" placeholder="e.g. Simpsonas" value="<?php getInputVal('registerLastname') ?>" required>   
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php echo $account->getError(Constants::$emailNotMatch) ?>
            <?php echo $account->getError(Constants::$emailInvalid) ?>
            <?php echo $account->getError(Constants::$emailTaken) ?>
            <label for="registerEmail">Your Email</label>
            <input type="email" class="form-control" id="registerEmail" name="registerEmail" placeholder="e.g. Bartas.simpsonas@gmail.com" value="<?php getInputVal('registerEmail') ?>" required>        
        </div>
        <div class="col">
        <label for="registerEmail2">Confirm Email</label>
            <input type="email" id="registerEmail2" class="form-control" name="registerEmail2" placeholder="e.g. Bartas.simpsonas@gmail.com" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php echo $account->getError(Constants::$passwordNotMatch) ?>
            <?php echo $account->getError(Constants::$passwordNotAlphanumeric) ?>
            <?php echo $account->getError(Constants::$passwordShortLong) ?>
            <label for="registerPassword">Your Password</label>
            <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="Your Password" required>
        </div>
        <div class="col">
            <label for="registerPassword2">Confirm Password</label>
            <input type="password" class="form-control" id="registerPassword2" name="registerPassword2" placeholder="Repeat your Password" required>
        </div>
    </div>
        <button class="registerButton btn btn-primary mt-3" type="submit" name="registerButton">Register</button>
    </form>
</div>
    

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>