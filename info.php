<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
   
    <?php 
     
    $hierarchy = $gender = $birthdate = $birthplace = $marriage = $nationality = $degree = $doctorDeg = $language = $nativeLanguage = $surname = $name = $email = "";
    $nameErr = $emailErr = $surnameErr = $birthplaceErr =  "";
    $signed = $selected = "";

    //Form input validation
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
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

        Gender:
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <br><br>

        Birth date:
        <input type="text" name="birthdate">
        <br><br>

        Birthplace:
        <input type="text" name="birthplace">
        <span class="error">*<?php echo $birthplaceErr;?></span>
        <br><br>

        Marriage status:
        <input type="radio" name="marriage" value="married">Married
        <input type="radio" name="marriage" value="single">Single
        <input type="radio" name="marriage" value="divorced">Divorced
        <input type="radio" name="marriage" value="widowed">Widowed
        <br><br>

        Nationality:
        <input type="text" name="nationality">
        <br><br>

        Education:
        <input type="radio" name="education" value="">
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
    $birthdate = strtotime($birthdate);
    $myfile = fopen("newfile.txt", "w") or die ("Unable to open file");
    if(isset($_POST['submit']))
    {
        $selected = $_POST['marriage'];
    }


    fwrite($myfile, $name.PHP_EOL);
    fwrite($myfile, $surname.PHP_EOL);
    fwrite($myfile, $birthdate.PHP_EOL);
    fwrite($myfile, $birthplace.PHP_EOL);
    fwrite($myfile, $email.PHP_EOL);
    fwrite($myfile, $signed.PHP_EOL);
    fclose($myfile);

    ?>    


    <?php
    //Test variable output
    echo "<h2>Your input:</h2>";
    echo "$name <br>";
    echo "$surname <br>";
    echo "$email <br>";
    echo "$gender <br>";
    echo "$birthdate <br>";
    echo "$birthplace <br>";
    echo "$selected <br>";
    echo $signed;
    ?>


    
</body>
</html>