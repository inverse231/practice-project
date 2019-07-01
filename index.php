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
    Email:<input type="text" name="email">
    Password:<input type="password" name="password">
    <input type="submit" name="submit">
    <a href="form.php">Sign up</a>
</header>

<?php
$email = $_POST['email'];

/*
$servername = "localhost";
$username = "root";
$password = "20849022";
$login = $_POST['login'];
var_dump($_POST);


try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT Nickname FROM SiteUsers WHERE Nickname = '$login'";
    if(isset($_POST['submit']))
    {
        $conn->exec($sql);  
    }
    
}

catch(PDOException $e)
{
    echo $sql."<br>".$e->getMessage();
}

$conn = null;
*/



//from phpdelusions

$host = "localhost";
$db   = "registration";
$user = "root";
$pass = "20849022";
$charset = "utf8mb4";
//$nickname = $_POST['nickname'];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->prepare("SELECT * FROM SiteUsers WHERE Email = ?");
    $stmt->execute($email); 
    $login = $stmt->fetch();
    
    if($login && password_verify($_POST['password'], $login['password']))
    {
        echo "ok!";
    } 
    
    else{
        echo "ok";
    }
    
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>





</body>
</html>