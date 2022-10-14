<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register form</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <form>
        <h2>Register form</h2>
        <h4>All fields are <span>required</span></h4>

        <label for="">FIO</label>
        <input type="text" name="username" placeholder="Enter your full name">

        <label for="">Login</label>
        <input type="text" name="login" placeholder="Enter your login">

        <label for="">E-mail</label>
        <input type="email" name="email" placeholder="Enter your e-mail address">

        <label for="">Password</label>
        <input type="password" name="password" placeholder="Enter your password">

        <label for="">Password Confirmation</label>
        <input type="password" name="password_confirm" placeholder="Confirm your password">

        <button type="submit" name="submit" class="register-btn">Submit</button>
        <p>Do u have an account? - <a href="/index.php"><span>authorization</span></a>!</p>

        <p class="error msg-none">jhfj</p>
    </form>

    <script src="jquery-3.6.1.min.js"></script>
    <script src="main.js"></script>
</body>
</html>