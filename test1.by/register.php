<?php require("signup.class.php"); ?>
<?php
    if(isset($_POST['submit'])) {
        $user = new RegisterUser($_POST['username'], $_POST['login'], $_POST['email'],
            $_POST['password'], $_POST['password_confirm']) ;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register form</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<form action="" method="post">
    <h2>Register form</h2>
    <h4>All fields are <span>required</span></h4>

    <label for="">FIO</label>
    <input id="username" type="text" name="username" placeholder="Enter your full name">

    <label for="">Login</label>
    <input type="text" name="login" placeholder="Enter your login">

    <label for="">E-mail</label>
    <input type="email" name="email" placeholder="Enter your e-mail address">

    <label for="">Password</label>
    <input type="password" name="password" placeholder="Enter your password">

    <label for="">Password Confirmation</label>
    <input type="password" name="password_confirm" placeholder="Confirm your password">

    <button type="submit" name="submit">Submit</button>
    <p>Do u have an account? - <a href="/index.php"><span>authorization</span></a>!</p>

    <p class="error"><?php echo @$user->error ?></p>
    <p class="success"><?php echo @$user->success ?></p>

</form>
</body>
</html>