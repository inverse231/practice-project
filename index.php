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

        curl_setopt($ch, CURLOPT_URL, "https://gender-api.com/get?name=elizabeth&key=DPkAQulLHrRaRPBdWc");
        curl_setopt($ch, CURLOT_HTTPHEADER, $header);
        curl_setopt($ch, CURL_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURL_RETURNTRANSFET, 1);


        $result = curl_exec($ch);

    }


    $hierarchy = $work = $gender = $birthdate = $birthplace = $marriage = $nationality = $degree = $doctorDeg = $language = $nativeLanguage = $surname = $name = $email = "";
    $nameErr = $emailErr = $surnameErr = $birthplaceErr = $birthdateErr =  "";
    $signed = $selected = "";

    //Form input validation
    if($_SERVER["REQUEST_METHOD"] == "POST")
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

        


        /*foreach($_POST as $value)
        {
            if(empty($_POST["value"]))
                $error = "Обязательное поле";
        }*/
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
    <div id="qform" align="center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h1 id="header">Введите свои данные:</h1>
        
            <p>Имя: <input type="text" name="name">
            <span class="error">* <?php echo $nameErr;?></span></p>
            

            <p>Фамилия: <input type="text" name="surname">
            <span class="error">* <?php echo $surnameErr;?></span></p>

            <p>Пол:<br>
            <input type="radio" name="gender" value="female">Женский<br>
            <input type="radio" name="gender" value="male">Мужской<br>
            </p>

            <p>Дата рождения:
            <input type="text" name="birthdate">
            <span class="error">* <?php echo $birthdateErr;?></span>
            </p>

            <p>Место рождения:
            <input type="text" name="birthplace">
            <span class="error">*<?php echo $birthplaceErr;?></span>
            </p>

            <p>Семейное положение:<br>
            <input type="radio" name="marriage" value="married">Замужем/женат<br>
            <input type="radio" name="marriage" value="single">Холост<br>
            <input type="radio" name="marriage" value="divorced">Разведен(а)<br>
            <input type="radio" name="marriage" value="widowed">Вдова/вдовец<br>
            </p>

            <p>Национальность:
            <input type="text" name="nationality">
            </p>

            <p>Образование:<br>
            <input type="radio" name="education" value="elementary">Начальная школа<br>
            <input type="radio" name="education" value="mid">Среднее образование<br>
            <input type="radio" name="education" value="bachelor">Неполное высшее (бакалавр)<br>
            <input type="radio" name="education" value="specialist">Специалист<br>
            <input type="radio" name="education" value="master">Магистр<br>
            <input type="radio" name="education" value="phd">Кандидат в доктора наук<br>
            <input type="radio" name="education" value="ph.d">Доктор наук<br>
            </p>

            <p>Место работы:
            <input type="text" name="work">
            </p>

            <p>Назовите языки, на которых вы говорите:<br>
            <textarea rows="4" cols="30" name="language"></textarea>
            </p>

            <p>E-mail: <input type ="text" name="email">
            <span class="error">* <?php echo $emailErr; ?> </span>
            </p>

            <p><input type="submit" value="Отправить"></p>  
    </form>
    </div>
    <br><br>

    <?php
    //Writing to file
    $signed = "Signed: ".date("d/M/Y");
    file_put_contents("test_output.txt", "");
    foreach($_POST as $key=>$value){
        file_put_contents("test_output.txt",$key.'='.$value.PHP_EOL,FILE_APPEND);
    }
    file_put_contents("test_output.txt", $signed.PHP_EOL,FILE_APPEND);

    //Test variable output
    echo "<h2>Your input:</h2>";
    print_r($_POST);
    ?>

</body>
</html>