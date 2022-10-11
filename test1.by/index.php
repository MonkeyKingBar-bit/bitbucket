<?php require("login.class.php"); ?>
<?php
    if(isset($_POST['submit'])) {
        $user = new LoginUser($_POST['login'], $_POST['password']);
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in form</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <h2>Login form</h2>
        <h4>All fields are <span>required</span></h4>

        <label for="">Login</label>
        <input type="text" name="login" placeholder="Enter your login">

        <label for="">Password</label>
        <input type="password" name="password" placeholder="Enter your password">

        <button type="submit" name="submit">Log in</button>
        <h4>Don't have an account? - <a href="/register.php">registration</a>!</h4>

        <p class="error"><?php echo @$user->error ?></p>
        <p class="success"><?php echo @$user->success ?></p>
    </form>
</body>
</html>