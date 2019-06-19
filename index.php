<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css">
    <script src="main.js"></script>
</head>
<body>
<header>
    <h1>Login page</h1>
    Login:<input type="text">
    Password:<input type="password">
    <input type="submit">
    <a href="form.php">Sign up</a>
</header>

<?php
$servername = "localhost";
$username = "root";
$password = "20849022";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql = "CREATE DATABASE loginDB";
    //$conn->exec($sql);
    echo "2";
}

catch(PDOException $e)
{
    echo $sql."<br>".$e->getMessage();
}

$conn = null;
?>



</body>
</html>