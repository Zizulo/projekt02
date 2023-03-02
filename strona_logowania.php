<?php

    session_start();

    if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true)){
        header('Location: index.php');
        exit(); //konczymy wykonywanie i przechodzimy do index.php
    }

    //usuwamy zmienne w razie nieudanej walidacji
    if(isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
    if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
    if(isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
    if(isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
    if(isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);

    //usuwanie bledow rejestracji
    if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
    if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
    if(isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
    if(isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
    if(isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);

?>


<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Strona logowania</title>
        <meta name="description" content="Wypożycz swój wymarzony model samochodu!">
        <meta name="keywords" content="samochód, katalog, salon, wypożyczalnia aut, pancar sharing studio">
        <meta name="author" content="Cezary Figurski">

        <meta http-equiv="X-Ua-Compatible" content="IE=edge">

        <link rel="stylesheet" href="css/main_str_log.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" />

        <!--[if lt IE 9]>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	    <![endif]-->

    </head>
    <body>
        <header>
            <div>
                <h1>Strona logowania</h1>
            </div>
            <div id="under_header">
                <img src="img/logo.png">
            </div>
            <div id="under_header">
                PanCar Sharing Studio
            </div>
        </header>
        <main>
            <form action="zaloguj.php" method="post">
                <div id="up_main">
                    Login:
                    <div><input type="text" name="login"></div>
                    Hasło:
                    <div><input type="password" name="haslo"></div>
                    <div id="log_pas">
                        <div><input type="submit" value="Zaloguj się"> <a href="strona_rejestracji.php"><input type="button" value="Zarejestruj się"></a></div>
                    </div>
                </div>
            </form>

            <?php

                if(isset($_SESSION['blad'])){
                    echo $_SESSION['blad'];
                }

            ?>

            <div style="clear: both;"></div>
            <div id="under_main">
                    <img src="img/AudiA6.jpg" id="car" width="371">
                    <img src="img/RenaultTalisman.jpg" id="car">
                    <img src="img/FiatTipo.jpg" id="car" width="316">
            </div>
        </main>
        <footer>
            Najlepsze auta tylko u nas ! &copy; Wszelkie prawa zastrzeżone 
            <div style="clear: both;"></div>
            <ul id="footer1" class="footer1">
                <li><i class="icon-direction">Janów ul.Konwaliowa 35</i></li>
                <li><i class="icon-phone">48 76 453 43</i></li>
                <li><i class="icon-mail-alt">pancarsharingstudio@gmail.com</i></li>
            </ul>
        </footer>
    </body>
</html>