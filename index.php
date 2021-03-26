<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Panel | CrafterGames</title>

    <link rel="icon" type="image/png" href="./assets/img/favicon.png">


    <link rel="stylesheet" href="../assets/css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">


</head>
<body style="font-family: 'PT Serif', serif; background-image: url('../assets/img/Panelbackground.png');">
<noscript>
    <style>
        .content.main {
            visibility: hidden;
        }
    </style>
    <a style="color: white;">Bitte aktiviere Javascript, um diese Seite aufrufen zu können.</a>
</noscript>
<style>



    #footer {
        position: fixed;
        background-color: rgba(0, 0, 0, 100);
        top: 92%;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 25px;
        text-align: center;

    }




    #balken {
        position: static;
        background-color: rgba(0, 0, 0, 100);
        top: 0;
        left: 0;

        height: 0%;
        padding: 25px;
        text-align: left;
    }



    #login {
        background-color: rgba(64, 64, 64, 100);
        position: absolute;
        top: 25%;
        left: 20%;
        width: 60%;
        height: 15%;
        padding: 20px;
        text-align: center;
        border: 5px solid #878787;
        border-radius: 25px;
    }

    #header {
        font-size: 25px;
        font-weight: 600;
    }

    #submit {

        cursor: pointer;
        height: 2%;
        border: none;
        border-radius: 1rem;
        padding: 1rem 2rem 1rem 2rem;
        position: relative;
        font-size: 1.6rem;
        color: white;
        background-color: black;

    }

    #alert {
        top: 30%;
        left: 10%;
        position: static;
        border: 2px solid #000000;
        background-color: #ff5252;
        text-align: center;
    }

    #username-box {
        position: absolute;
        top: 38%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: black;
        height: 10px;
        border-radius: 40px;
        padding: 10px;
    }

    #username-txt {
        border: none;
        background: none;
        outline: none;
        float: left;
        padding: 0;
        color: white;
        font-size: 16px;
        transition: 0.4s;
        width: 240px;
    }

    #password-box {
        position: absolute;
        top: 54%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: black;
        height: 10px;
        border-radius: 40px;
        padding: 10px;
    }

    #password-txt {
        border: none;
        background: none;
        outline: none;
        float: left;
        padding: 0;
        color: white;
        font-size: 16px;
        transition: 0.4s;
        width: 240px;
    }

    #loginkey {
        color: #e84118;
        float: left;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: black;
        display: flex;
        justify-content: left;
        transition: 0.4s;
        color: white;
        cursor: pointer;
    }

    #logintxt {
        line-height: 30%;
    }





    @media (min-width: 600px) {
        #login {
            background-color: rgba(64, 64, 64, 100);
            position: absolute;
            top: 25%;
            left: 40%;
            width: 20%;
            height: 35%;
            padding: 20px;
            text-align: center;
            border: 5px solid #878787;
            border-radius: 25px;
        }

        #submit {
            width: 70%;
            left: 0;
        }
    }
</style>
<main class="content main size-fullscreen">
    <div id="balken">
        <a id="balken" style="color:#ffffff">CrafterGames.net Admin Panel</a>
    </div>
    <?php
    $year = date("Y");
    function alert($text)
    {
        echo "<div id='alert' class='alert alert-danger text-center fade show' role='alert' >
                        <strong>Fehler!</strong> $text
                    </div>";

        echo "
                    <script>
                    function fade()
                    {
                        setTimeout(function(){
                            alertmessage = $('#alert');

                            alertmessage.fadeOut(2000);
                        }, 5000);
                    }
                    fade();
                    </script>";
    }
    session_start();
    if(isset($_SESSION["username"]))
    {
        header("Location: interface.php");
        exit;
    }
    session_destroy();
    if(isset($_POST["submit"]))
    {
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
        $stmt->bindParam(":user", $_POST["username"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1)
        {
            $row = $stmt->fetch();

            if($row["PASSWORD"] == hash('sha256', $_POST["password"]))
            {
                session_start();
                $_SESSION["username"] = $row["USERNAME"];
                header("Location: interface.php");
                exit;
            } else {
                alert("Das angegebene Passwort ist falsch.");
            }
        } else {
            alert("Der angegebene Benutzername wurde nicht gefunden.");
        }
    }


    ?>



    <div id="login">
        <a id="header" style="color:#ffffff">Admin Panel | Login</a>
        <form action="index.php" method="post" style="padding-top: 25%; padding-left: 20px; padding-right: 20px;">
            <div id="username-box" class="username-box">
                <input type="text" id="username-txt" class="username-txt" name="username" placeholder="Benutzername" style="text-align: center;" required>
            </div>
            <div id="password-box" class="password-box">
                <input type="password" id="password-txt" class="password-txt" name="password" placeholder="Passwort" style="text-align: center;" required>

            </div>

            <button id="submit" type="submit" name="submit" class="btn btn-success" style="margin-top: 40%;">
                <img id="loginkey" src="./assets/img/key-small.png">
                <span id="logintxt">Login</span>
            </button>
        </form>
    </div>

    <div id="footer">
        <a id="footer" style="color:#ffffff">Created by JavaLama and Happy_Lama_ with <span style="color: red;">❤</span> | Copyright © 2021 - CrafterGames.net</a>
    </div>

</main>
</body>
</html>
