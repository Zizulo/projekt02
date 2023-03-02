<?php

    session_start(); //funkcja ktora pomaga korzystac z sesji
    // kazda strona ktora chce korzystac z sesji musi miec to na gorze swojej strony 

    if(!isset($_POST['login']) || (!isset($_POST['haslo']))){
        header('Location: strona_logowania.php');
        exit();
    }

    require_once "dbconnect.php";

    //$polaczenie = @new mysqli($host,$user,$password,$database);

    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
            $polaczenie = new mysqli($host,$user,$password,$database);
            if($polaczenie->connect_errno!=0) //obsluga błedow polaczenia
            {
                throw new Exception(mysqli_connect_errno());
            }
            else{
                $login = $_POST['login'];
                $haslo = $_POST['haslo'];

                $login = htmlentities($login, ENT_QUOTES, "UTF-8");

                if($rezultat = @$polaczenie->query(
                    sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",  //%s - czyli wstawiamy zmienną typu string w miejsce %s, czyli wstawi pierwszy element po przecinku - mysqli_real_escape_string($polaczenie,$login) itd
                mysqli_real_escape_string($polaczenie,$login), // ta funkcja mysqli zabezpiecza przed wstrzykiwaniem zapytan mysql
                )))
                {
                    $ile_userow = $rezultat->num_rows;
                    if($ile_userow>0){

                        $wiersz = $rezultat->fetch_assoc();

                        if(password_verify($haslo, $wiersz['pass']))
                        {

                            $_SESSION['zalogowany'] = true;
                            
                            
                            $_SESSION['id'] = $wiersz['id']; // sprawdzamy kto sie zalogowal po id
                            $_SESSION['user'] = $wiersz['user'];  //wyciaga z tablicy z kolumny user
                            // a SESSION to tablica asocjacyjna dzięki której przesyłamy dane pomiędzy stronami
                            $_SESSION['email'] = $wiersz['email'];

                            unset($_SESSION['blad']); // jesli udalo nam sie zalogowac usuwamy zmienna blad
                            $rezultat->free_result(); //czyscimy zapytanie

                            header('Location: index.php'); //przekierowuje do strony index.php
                        }
                        else{

                            $_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login lub hasło</span>';
                            header('Location: strona_logowania.php');
            
                        }

                    }else{

                        $_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login lub hasło</span>';
                        header('Location: strona_logowania.php');

                    }
                }

                $polaczenie->close();
        }
    }
    catch(Exception $e){
        echo '<span style="color:red;">"Błąd serwera. Proszę wrócić później"</span>';
           // echo 'Informacja developerska: '.$e;
    }

    /*if($polaczenie->connect_errno!=0) //obsluga błedow polaczenia
    {
        echo "Error: ".$polaczenie->connect_errno;
    }*/
    /*else
    {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        if($rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",  //%s - czyli wstawiamy zmienną typu string w miejsce %s, czyli wstawi pierwszy element po przecinku - mysqli_real_escape_string($polaczenie,$login) itd
        mysqli_real_escape_string($polaczenie,$login), // ta funkcja mysqli zabezpiecza przed wstrzykiwaniem zapytan mysql
)))
        {
            $ile_userow = $rezultat->num_rows;
            if($ile_userow>0){

                $wiersz = $rezultat->fetch_assoc();

                if(password_verify($haslo, $wiersz['pass']))
                {

                    $_SESSION['zalogowany'] = true;
                    
                    
                    $_SESSION['id'] = $wiersz['id']; // sprawdzamy kto sie zalogowal po id
                    $_SESSION['user'] = $wiersz['user'];  //wyciaga z tablicy z kolumny user
                    // a SESSION to tablica asocjacyjna dzięki której przesyłamy dane pomiędzy stronami
                    $_SESSION['email'] = $wiersz['email'];

                    unset($_SESSION['blad']); // jesli udalo nam sie zalogowac usuwamy zmienna blad
                    $rezultat->free_result(); //czyscimy zapytanie

                    header('Location: index.php'); //przekierowuje do strony index.php
                }
                else{

                    $_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login lub hasło</span>';
                    header('Location: strona_logowania.php');
    
                }

            }else{

                $_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login lub hasło</span>';
                header('Location: strona_logowania.php');

            }
        }

        $polaczenie->close();
    }*/
?>