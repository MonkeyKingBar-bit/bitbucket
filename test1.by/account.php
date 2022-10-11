<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location: index.php"); exit();
    }
    if(isset($_GET['logout'])){
        unset($_SESSION['user']);
        header("location: index.php"); exit();
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User account</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="content">
        <header>
            <h2>Welcome <?php echo $_SESSION['user']; ?></h2>
            <a href="?logout">Log out</a>
        </header>

        <main>
            <h3>Some user actions .....</h3>
        </main>
    </div>
</body>
</html>