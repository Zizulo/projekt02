<?php

    session_start();
    define('SITE_KEY', '6LfJTq4kAAAAAN4aDmhnxYW-DBnNPPMLC4igVhti');
    define('SECRET_KEY', '6LfJTq4kAAAAAAp8qVcLeeTZQol3CZys3AbbdtBW');

    /*use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';*/

    if(isset($_POST['email'])){
        
        $wszystko_OK=true; // udana walidacja

        //sprawdzamy popr logina
        $nick = $_POST['nick'];

        //sprawdzenie dl logina
        if(strlen($nick)<3 || (strlen($nick)>24)){
            $wszystko_OK=false;
            $_SESSION['e_nick'] = "Login musi posiadać od 3 do 24 znaków";
        }

        if(ctype_alnum($nick)==false){
            $wszystko_OK=false;
            $_SESSION['e_nick']="Login może składać się z tylko liter i cyfr(bez polskich znaków)";
        }

        //sprawdz popr adr email
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)){
            $wszystko_OK=false;
            $_SESSION['e_email']="Podaj poprawny adres e-mail";
        }

        //spr popr hasla
        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];

        if((strlen($haslo1)<8)||(strlen($haslo1)>24)){
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 24 znaków";
        }

        if($haslo1!=$haslo2){
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Podane hasła nie są identyczne";
        }

        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

        //czy zaakc regulamin
        if(!isset($_POST['regulamin'])){
            $wszystko_OK=false;
            $_SESSION['e_regulamin']="Potwierdź akceptację regulaminu";
        }

        //bot or not
        $sekret = "6LfJTq4kAAAAAAp8qVcLeeTZQol3CZys3AbbdtBW";

        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

        $odpowiedz = json_decode($sprawdz);

        if($odpowiedz->success==false){
            $wszystko_OK=false;
            $_SESSION['e_bot']="Potwierdź, że nie jesteś botem";
        }

        //zapamietaj wprow dane
        $_SESSION['fr_nick']= $nick;
        $_SESSION['fr_email']= $email;
        $_SESSION['fr_haslo1']= $haslo1;
        $_SESSION['fr_haslo2'] = $haslo2;
        if(isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

        require_once "dbconnect.php";

        mysqli_report(MYSQLI_REPORT_STRICT); // rzucamy wyjatkami a nie ostrzezeniami, aby nie wyciekly zadne wazne dane podczas wyswietlenia bledu

        try{

            $polaczenie = new mysqli($host,$user,$password,$database);
            if($polaczenie->connect_errno!=0) //obsluga błedow polaczenia
            {
                throw new Exception(mysqli_connect_errno());
            }
            else{
                //czy email juz istnieje w bazie
                $rezultat = $polaczenie->query("SELECT id from uzytkownicy where email='$email'");

                if(!$rezultat) throw new Exception($polaczenie->error);
                $ile_takich_maili = $rezultat->num_rows;
                if($ile_takich_maili>0){
                    $wszystko_OK=false;
                    $_SESSION['e_email']="Istnieje już konto z takim adresem email";
                }

                //czy login juz istnieje w bazie
                $rezultat = $polaczenie->query("SELECT id from uzytkownicy where user='$nick'");

                if(!$rezultat) throw new Exception($polaczenie->error);
                $ile_takich_nickow = $rezultat->num_rows;
                if($ile_takich_nickow>0){
                    $wszystko_OK=false;
                    $_SESSION['e_nick']="Istnieje już konto z takim nazwą login";
                }

                if($wszystko_OK==true){
                    //Dodajemy uzytkownika do bazy
                    if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email')")){
                        //$_SESSION['udana_rejestracja']=true;
                        $to = $_POST['email'];
                        $from = 'CarSharing Studio <no-reply@great-site.net>';
                        //$from = '=?UTF-8?B?'.base64_encode('Carsharing Studio'). '?= <no-reply@great-site.net>'; - wiad tekst
                        $replyTo = 'Biuro <zzzzzzettyolo@gmail.com>'; 
                        //$replyTo = '=?UTF-8?B?'.base64_encode('Biuro'). '?= <zzzzzzettyolo@gmail.com>'; - wiad tekst
                        $subject = 'CarSharing Studio - poprawna rejestracja';
                        //$subject = '=?UTF-8?B?'.base64_encode('CarSharing Studio - poprawna rejestracja'). '?='; - wiad tekst
                        $message = '
                            <html>
                                <head>
                                    <title>Dziękujemy za rejestrację na naszej stronie</title>
                                </head>
                                <body>
                                    <h1>Cześć!</h1>
                                    <p>Dzięki, że zarejestrowałeś się na naszej stronie :) </p>
                                    <hr>
                                    <p>Administratorem twoich danych osobowych jest:</p>
                                    <p>CarSharing Studio Sp.z.o.o, Janów ul.Konwaliowa 35, 26-900 Kozienice</p>
                                </body>
                            </html> 
                        ';
                        
                        $headers = 'MIME-Version: 1.0'."\r\n";
                        $headers = 'Content-Type: text/html; charset=utf-8'."\r\n";
                        //$headers = 'Content-Type: text/plain; charset=utf-8'."\r\n";
                        //$headers = 'Content-Transer-Encoding: base64'."\r\n";
                        $headers = 'From: '.$from."\r\n";
                        $headers .= 'Reply-To: '.$replyTo."\r\n";
                        mail($to, $subject, $$message, $headers);

                        /*try{
                            $mail = new PHPMailer();

                            $mail->isSMTP();

                            $mail->Host = 'smtp.gmail.com';
                            $mail->Port = 465;
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

                        } catch(Exception $e){
                            echo "Błąd wysyłania maila: {$mail->ErrorInfo}";
                        }*/
                        header('Location: strona_logowania.php');
                    }
                    else{
                        throw new Exception($polaczenie->error);
                    }   
                }

                $polaczenie->close();
            }
        }
        catch(Exception $e){
            echo '<span style="color:red;">"Błąd serwera. Proszę wrócić później"</span>';
           // echo 'Informacja developerska: '.$e;
        }
    }

    /*if($_POST){
        function getCaptcha($SecretKey){
            $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
            $Return = json_decode($Response);
            return $Return;
        }
        $Return = getCaptcha($_POST['g-recaptcha-response']);
        //var_dump($Return);
        if($Return->succes == true && $Return->score > 0.5 ){
            echo "Sukces";
        }
        else{
            echo "Jesteś robotem";
        }
    }*/

?>


<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Strona rejestracji</title>
        <meta name="description" content="Wypożycz swój wymarzony model samochodu!">
        <meta name="keywords" content="samochód, katalog, salon, wypożyczalnia aut, pancar sharing studio">
        <meta name="author" content="Cezary Figurski">

        <meta http-equiv="X-Ua-Compatible" content="IE=edge">

        <link rel="stylesheet" href="css/main_str_log.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" />

        <script src='https://www.google.com/recaptcha/api.js'></script>

        <!--[if lt IE 9]>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	    <![endif]-->

    </head>
    <body>
        <header>
            <div>
                <h1>Strona rejestracji</h1>
            </div>
            <div id="under_header">
                <img src="img/logo.png">
            </div>
            <div id="under_header">
                PanCar Sharing Studio
            </div>
        </header>
        <main>
            <form method="post">
                <div id="up_main">
                    Login:
                    <div><input type="text" name="nick" value="<?php
                    if(isset($_SESSION['fr_nick'])){
                        echo $_SESSION['fr_nick'];
                        unset($_SESSION['fr_nick']);
                    } ?>"></div>
                    <?php
                        if(isset($_SESSION['e_nick'])){
                            echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                            unset($_SESSION['e_nick']);
                        } 
                    ?>
                    Email:
                    <div><input type="text" name="email" value="<?php
                    if(isset($_SESSION['fr_email'])){
                        echo $_SESSION['fr_email'];
                        unset($_SESSION['fr_email']);
                    } ?>"></div>
                    <?php
                        if(isset($_SESSION['e_email'])){
                            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                            unset($_SESSION['e_email']);
                        } 
                    ?>
                    Hasło:
                    <div><input type="password" name="haslo1" value="<?php
                    if(isset($_SESSION['fr_haslo1'])){
                        echo $_SESSION['fr_haslo1'];
                        unset($_SESSION['fr_haslo1']);
                    } ?>"></div>
                    Powtórz hasło:
                    <div><input type="password" name="haslo2" value="<?php
                    if(isset($_SESSION['fr_haslo2'])){
                        echo $_SESSION['fr_haslo2'];
                        unset($_SESSION['fr_haslo2']);
                    } ?>"></div>
                    <?php
                        if(isset($_SESSION['e_haslo'])){
                            echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                            unset($_SESSION['e_haslo']);
                        } 
                    ?>
                    <label><div><a href="regulamin_strony.html"><input type="checkbox" name="regulamin" <?php
                    if(isset($_SESSION['fr_regulamin'])){
                        echo "checked";
                        unset($_SESSION['fr_regulamin']);
                    } ?>>Akceptuję regulamin</div></a></label>
                    <?php
                        if(isset($_SESSION['e_regulamin'])){
                            echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                            unset($_SESSION['e_regulamin']);
                        } 
                    ?>
                    <div class="g-recaptcha" data-sitekey="6LfJTq4kAAAAAN4aDmhnxYW-DBnNPPMLC4igVhti"></div>
                    <?php
                        if(isset($_SESSION['e_bot'])){
                            echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                            unset($_SESSION['e_bot']);
                        } 
                    ?>
                    <div id="log_pas">
                        <div><a href="strona_logowania.php"><input type="submit" value="Zarejestruj się"></a> <a href="strona_logowania.php"><input type="button" value="Anuluj"></a></div>
                    </div>
                </div>
            </form>
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