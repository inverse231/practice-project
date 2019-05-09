<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
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


    $hierarchy = $gender = $birthdate = $year = $month = $day = $birthplace = $marriage = $nationality = $degree = $doctorDeg = $language = $nativeLanguage = $surname = $name = $email = "";
    $nameErr = $emailErr = $surnameErr = $birthplaceErr =  "";
    $signed = $selected = "";

    //Form input validation
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $education = $_POST['education'];
        $doctorDeg = $_POST['doctorDeg'];


        if(empty($_POST["name"]))
            $nameErr = "Name is required";
        else
            {
                $name = test_input($_POST["name"]);
                if(!preg_match("/^[a-zA-Z]*$/", $name))
                {
                    $nameErr = "Names must only contain letters and whitespaces";
                }
            }

        if(empty($_POST["surname"]))
            $surnameErr = "Surname is required";
        else
            {
                $surname = test_input($_POST["surname"]);
                if(!preg_match("/^[a-zA-Z]*$/", $surname))
                {
                    $surnameErr = "Surnames must only contain letters and whitespaces";
                }
            }

        if(empty($_POST["email"]))
            $emailErr = "E-mail is required";
        else
            {
                $email = test_input($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $emailErr = "Wrong E-mail format";
                }
            }

        if(empty($_POST["birthplace"]))
            $birthplaceErr = "Birthplace required";
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>


    <!--HTML form code-->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h1 align="center">Input your data here:</h1>
        Family hierarchy:
        <br><br>

        Name: <input type="text" name="name">
        <span class="error">* <?php echo $nameErr;?></span> 
        <br><br>

        Surname: <input type="text" name="surname">
        <span class="error">* <?php echo $surnameErr;?></span>
        <br><br>

        Gender:<br>
        <input type="radio" name="gender" value="female">Female<br>
        <input type="radio" name="gender" value="male">Male<br>
        <br>

        Birth date: <br>
        Day   <input type="text" name="day"><br>
        Month <input type="text" name="month"><br>
        Year  <input type="text" name="year"><br>
        <br><br>

        Birthplace:
        <input type="text" name="birthplace">
        <span class="error">*<?php echo $birthplaceErr;?></span>
        <br><br>

        Marriage status:<br>
        <input type="radio" name="marriage" value="married">Married <br>
        <input type="radio" name="marriage" value="single">Single<br>
        <input type="radio" name="marriage" value="divorced">Divorced<br>
        <input type="radio" name="marriage" value="widowed">Widowed<br>
        <br>

        Nationality:
        <input type="text" name="nationality">
        <br><br>

        Education:<br>
        <input type="radio" name="education" value="elementary">Elementary school<br>
        <input type="radio" name="education" value="mid">Mid school<br>
        <input type="radio" name="education" value="bac">Bachelor degree<br>
        <input type="radio" name="education" value="spec">Specialist<br>
        <input type="radio" name="education" value="mag">Master degree<br>
        <input type="radio" name="education" value="phd">PhD<br>
        <input type="radio" name="education" value="ph.d">Ph.D<br>
        
        <br>

        Name the languages that you speak:<br>
        <textarea rows="4" cols="30" name="language"></textarea>
        <br><br>

        E-mail: <input type ="text" name="email">
        <span class="error">* <?php echo $emailErr; ?> </span>
        <br>

        <input type="submit">
    </form>
    
    <br><br>

    <?php
    //Writing to file
    $signed = "Signed: ".date("D/M/Y");
    file_put_contents("test_output.txt", "");
    foreach($_POST as $key=>$value){
        file_put_contents("test_output.txt",$key.'='.$value.PHP_EOL,FILE_APPEND);
    }

    //Test variable output
    echo "<h2>Your input:</h2>";
    print_r($_POST);
    ?>

</body>
</html>