<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Zamówienie PanCar Sharing Studio</title>
        <meta name="author" content="Cezary Figurski">

        <meta http-equiv="X-Ua-Compatible" content="IE=edge">

        <link rel="stylesheet" href="css/main_order.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">

    </head>
    <body>
<?php
            $ilenadwozie = $_POST['nadwozie'];
            $ilesilnik = $_POST['silnik'];
            $ilewyp = [];
            if(isset($_POST['wyp'])){
                $ilewyp = implode(", ", $_POST['wyp']);
            }
            $ilechoinka = [];
            if(isset($_POST['choinka'])){
                $ilechoinka = implode(", ", $_POST['choinka']);
            }
            $ilekluczyk = $_POST['kluczyk'];
            $iledata = $_POST['data'];
            $ileczas = $_POST['czas'];
            $ilekomentarz = $_POST['komentarz'];
?>
        
        <main>
            <header>
                <h1>Twoje zamówienie</h1>
            </header>
            <article>
<?php

echo<<<END
                <table>
                    <tr>
                        <td>Twoj nick</td> <td></td>
                    </tr>
                    <tr>
                        <td>Rodzaj nadwozia</td> <td>$ilenadwozie</td>
                    </tr>
                    <tr>
                        <td>Rodzaj auta</td> <td></td>
                    </tr>
                    <tr>
                        <td>Silnik</td> <td>$ilesilnik</td>
                    </tr>
                    <tr>
                        <td>Wyposażenie samochodu</td> <td>$ilewyp</td>
                    </tr>
                    <tr>
                        <td>Choinki zapachowe</td> <td>$ilechoinka</td>
                    </tr>
                    <tr>
                        <td>Kluczyki</td> <td>$ilekluczyk</td>
                    </tr>
                    <tr>
                        <td>Data dostawy</td> <td>$iledata</td>
                    </tr>
                    <tr>
                        <td>Czas dostawy</td> <td>$ileczas</td>
                    </tr>
                    <tr>
                        <td>Komentarz</td> <td>$ilekomentarz</td>
                    </tr>
                    <tr>
                        <td>Faktura</td> <td></td>
                    </tr>
                    <tr>
                        <td>Cena startowa</td> <td>PLN</td>
                    </tr>
                </table>
                <input id="button" type="submit" value="Wyślij zamówienie">
                <a href="index.php"><input id="button" type="submit" value="Edytuj"></a>

END;

?>
            </article>
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