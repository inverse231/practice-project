<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css">
    <script src="main.js"></script>
</head>
<body>
   
    <?php 

    function print_b($variable, $text){
        echo "<p1>";
        print_r($variable);
        echo "</p1>";
        echo "<pre>";
        print_r($variable);
        echo "</pre>";
    }

    function gender_detect($variable)
    {
        $ch = curl_init();
        $header = array('Accept: application/json', 'Content-type: application/json');
        //curl_setopt($ch, CURLOPT_URL, "https://gender-api.com/get?name=".$variable."&country=RU&key=DPkAQulLHrRaRPBdWc");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURL_HTTPGET, 1);

       //$result = curl_exec($ch);
        //file_put_contents("name.json", $result);
        //echo $result;

        $json = json_decode("name.json", true);
        echo '<pre>'.print_r($json).'</pre>';
        $genderFromName = $json['gender'];
        echo $genderFromName;
    }


    $id = $work = $gender = $pass = $birthdate = $language = $surname = $name = $email = $country = $nickname = "";
    $nameErr = $emailErr = $surnameErr = $birthplaceErr = $birthdateErr =  "";
    $signed = $selected = "";

    //Form input validation
    /*if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["name"]))
            $nameErr = "Обязательное поле";
        else
            {
                $name = test_input($_POST["name"]);
                if(!preg_match("/^[А-Яа-яЁё]*$/", $name))
                {
                    $nameErr = "Имя должно содержать буквы и пробелы";
                }
            }

        if(empty($_POST["surname"]))
            $surnameErr = "Обязательное поле";
        else
            {
                $surname = test_input($_POST["surname"]);
                if(!preg_match("/^[А-Яа-яЁё]*$/", $surname))
                {
                    $surnameErr = "Фамилия должна содержать буквы и пробелы";
                }
            }

        if(empty($_POST["email"]))
            $emailErr = "Обязательное поле";
        else
            {
                $email = test_input($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $emailErr = "Неправильный формат электронной почты";
                }
            }

        if(empty($_POST["birthdate"]))
            $birthdateErr = "Обязательное поле";
        else
        {
            //$birthdate = test_input($_POST["birthdate"]);
            if(!preg_match("/(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}/", $birthdate))
            {
                $birthdateErr = "Неправильный формат даты";
            }
        }

        if(empty($_POST["birthplace"]))
        {
            $birthplaceErr = "Обязательное поле";
        }
    }*/

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>


    <!--HTML form code-->
    <form class="regform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h1 class="formhead">Input your data:</h1>

        <p>Nickname: 
        <input type="text" name="nickname">
        </p>

        <p>Password:
        <input type="password" name="pass">
        </p>    
        
        <p>First Name:
        <input type="text" name="name">
        <span class="error">* <?php echo $nameErr;?></span></p>

        <p>Surname: 
        <input type="text" name="surname">
        <span class="error">* <?php echo $surnameErr;?></span></p>

        <p>Gender:<br>
        <input type="radio" name="gender" value="female">Female<br>
        <input type="radio" name="gender" value="male">Male<br>
        </p>

        <p>Birthdate:
        <input type="text" name="birthdate">
        <span class="error">* <?php echo $birthdateErr;?></span>
        </p>

        <p>Where do yo live:
        <input type="text" name="country">
        </p>

        <p>Language:
        <input type="text" name="language">
        </p>

        <p>E-mail: <input type ="text" name="email">
        <span class="error">* <?php echo $emailErr; ?> </span>
        </p>

        <p><input type="submit" name="submit" value="Submit">
        <?php
        $nickname = $_POST['nickname'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $country = $_POST['country'];
        $language = $_POST['language'];
        $email = $_POST['email'];
        $id = rand(0, 25);        
        ?>
        </p>  
    </form>
    <br><br>

    <?php
    //Writing to file
    /*$signed = "Signed: ".date("d/M/Y");
    file_put_contents("test_output.txt", "");
    foreach($_POST as $key=>$value){
        file_put_contents("test_output.txt",$key.'='.$value.PHP_EOL,FILE_APPEND);
    }
    file_put_contents("test_output.txt", $signed.PHP_EOL,FILE_APPEND);*/

    $username = "root";
    $password = "20849022";
    $servername = "localhost";
    $dbname = "registration";

    if(isset($_POST['submit'])){
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO SiteUsers (id, Nickname, Name, Surname, Gender, Birthdate, Country, Language, Email, password)
            VALUES ('$id', '$nickname', '$name', '$surname', '$gender', '$birthdate', '$country', '$language', '$email', '$pass');";
            $conn->exec($sql);
            echo "$id";
        }
        
        catch(PDOException $e)
        {
            echo $sql."<br>".$e->getMessage();
        }

    }

    //Test variable output
    echo "<h2>Your input:</h2>";
    print_r($_POST);
    var_dump($name);
    //gender_detect($name);
    ?>

</body>
</html>