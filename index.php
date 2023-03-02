<?php
    session_start();

    if(!isset($_SESSION['zalogowany'])){  //tą funkcje wkleic wszedzie gdzie moze zajrzec tylko zalog user
        header('Location: strona_logowania.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Wypożyczalnia samochodów</title>
        <meta name="description" content="Wypożycz swój wymarzony model samochodu!">
        <meta name="keywords" content="samochód, katalog, salon, wypożyczalnia aut, pancar sharing studio">
        <meta name="author" content="Cezary Figurski">

        <meta http-equiv="X-Ua-Compatible" content="IE=edge">

        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
        <link href="https://coin-birds.com/?en=Ziczko" target="_blank">

        <script src="timer.js"></script>

        <!--[if lt IE 9]>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	    <![endif]-->
    </head>
    <body onload="odliczanie();">
        <header>
            <div class="naglowek">
                <h1><div id="title">Wybierz konfigurację samochodu</div></h1>
                <div id="logo"><img src="img/logo.png"></div>
                <div id="clock">12:00:00</div>
                <div style="clear: both;"></div>
            </div>
            <nav class="naw">
                <li><div class="naw1"><i class="icon-user-circle"></i>
                    <?php
                        echo $_SESSION['email'];
                    ?>
                </div></li>
                <li><div class="naw1">
                    <?php
                        echo $_SESSION['user'];
                    ?>
                </div></li>
                <li><div class="naw1"><a>Kontakt</a></div></li>
                <li><div class="naw1"><a href="logout.php">Wyloguj się</a></div></li>
                <li><label><div>Szukaj <input type="search" placeholder="Czego szukasz?"></div></label></li>
            </nav>
        </header>
        <nav>
            <div class="naw2">
                <ol>
                    <li><div id="naw2_1">Rodzaj nadwozia</div></li>
                    <li><div id="naw2_1">Katalog</div></li>
                    <li><div id="naw2_1">Rodzaj silnika</div></li>
                    <li><div id="naw2_1">Wyposażenie samochodu</div></li>
                    <li><div id="naw2_1">Choinki zapachowe</div></li>
                    <li><div id="naw2_1">Kluczyki do samochodu</div></li>
                    <li><div id="naw2_1">Data dostawy</div></li>
                    <li><div id="naw2_1">Preferowany czas dostawy</div></li>
                    <li><div id="naw2_1">Uwagi do zamówienia</div></li>
                </ol>
            </div>
        </nav>
        <main>
            <article>
                <form action="order.php" method="post">
                    <div class="square_1">
                            <fieldset>
                                <legend>1. Rodzaj nadwozia</legend>
                                    <div id="nadwozie"><label><input value="SUV" type="radio" name="nadwozie" checked>SUV</label></div>
                                    <div id="nadwozie"><label><input value="CUV" type="radio" name="nadwozie">CUV</label></div>
                                    <div id="nadwozie"><label><input value="Sedan" type="radio" name="nadwozie">Sedan</label></div>
                                    <div id="nadwozie"><label><input value="Hatchback" type="radio" name="nadwozie">Hatchback</label></div>
                                    <div id="nadwozie"><label><input value="Cabriolet" type="radio" name="nadwozie">Cabriolet</label></div>
                                    <div id="nadwozie"><label><input value="Coupe" type="radio" name="nadwozie">Coupe</label></div>
                            </fieldset>
                    </div>
                    <div class="square_1_1">
                        <fieldset>
                            <legend>2. Katalog</legend>
                            <div class="katalog"><a href="sedan.html"><img src="img/AudiA6.jpg" width="95" height="60" alt="Sedan" title="Marki sedanów w naszej ofercie"></a></div>
                            <div class="katalog"><a href="cuv.html"><img src="img/NissanQashqai2017.jpg" width="95" height="60" alt="Cuv" title="Marki Cuv'ów w naszej ofercie"></a></div>
                            <div class="katalog"><a href="suv.html"><img src="img/Toyota_RAV4.jpg" width="95" height="60" alt="Suv" title="Marki Suv'ów w naszej ofercie"></a></div>
                            <div style="clear: both;"></div>
                            <div class="katalog1"><a href="hatchback.html"><img src="img/Toyota_Yaris.jpg" width="95" height="60" alt="Hatchback" title="Marki Hatchbacków w naszej ofercie"></a></div>
                            <div class="katalog1"><a href="cabriolet.html"><img src="img/BMW_120d_Cabriolet.jpg" width="95" height="60" alt="Cabriolet" title="Marki Cabrioletów w naszej ofercie"></a></div>
                            <div class="katalog1"><a href="coupe.html"><img src="img/Volkswagen-Eos.JPG" width="95" height="60" alt="Coupe" title="Marki Coupe'ów w naszej ofercie"></a></div>
                            <div style="clear: both;"></div>
                        </fieldset>
                    </div>
                    <div class="square_2">
                        <fieldset>
                            <legend>3. Rodzaj silnika</legend>
                            <select name="silnik">
                                <option>wysokoprężny(DIESEL)</option>
                                <option selected>benzynowy</option>
                                <option>elektryczny</option>
                                <option>hybrydowy</option>
                            </select>
                        </fieldset>
                        <fieldset>
                            <legend>4. Wyposażenie samochodu</legend>
                                <div><input id="v1" value="klimatyzacja" type="checkbox" disabled checked><label for="v1">klimatyzacja</label></div>
                                <div><input id="v2" value="systemy: ESP i ABS" type="checkbox" disabled checked><label for="v2">ESP i ABS</label></div>
                                <div><input id="v3" value="tapicerka skórzana" name="wyp[]" type="checkbox"><label for="v3">tapicerka skórzana</label></div>
                                <div><input id="v4" value="tempomat" name="wyp[]" type="checkbox"><label for="v4">tempomat</label></div>
                                <div><input id="v5" value="tylny spojler dachowy" name="wyp[]" type="checkbox"><label for="v5">spojler dachowy</label></div>
                                <div><input id="v6" value="radio z bluetooth" name="wyp[]" type="checkbox"><label for="v6">z bluetooth</label></div>
                                <div><input id="v7" value="reflektory przeciwmgłowe" name="wyp[]" type="checkbox"><label for="v7">przeciwmgłowe</label></div>
                                <div><input id="v8" value="przyciemniane tylne szyby" name="wyp[]" type="checkbox"><label for="v8">tylne szyby</label></div>
                                <div><input id="v9" value="czujniki parkowania" name="wyp[]" type="checkbox"><label for="v9">parkowania</label></div>
                                <div><input id="v10" value="podgrzewane fotele" name="wyp[]" type="checkbox"><label for="v10">podgrzewane fotele</label></div>
                                <div><input id="v11" value="składane lusterka" name="wyp[]" type="checkbox"><label for="v11">składane lusterka</label></div>
                                <div><input id="v12" value="światła LED do jazdy dziennej" name="wyp[]" type="checkbox"><label for="v12">światła LED do jazdy dziennej</label></div>
                        </fieldset>
                        <fieldset>
                            <legend>5. Choinki zapachowe</legend>
                                <select multiple>
                                    <option name="choinka[]" value="kokosowa">kokosowa</option>
                                    <option name="choinka[]" value="cytrynowa">cytrynowa</option>
                                    <option name="choinka[]" value="truskawkowa">truskawkowa</option>
                                    <option name="choinka[]" value="brzoskwiniowa">brzoskwiniowa</option>
                                    <option name="choinka[]" value="miętowa">miętowa</option>
                                    <option name="choinka[]" value="porzeczkowa">porzeczkowa</option>
                                </select>
                        </fieldset>
                        <fieldset>
                            <legend>6. Ile kluczyków</legend>
                                <input type="number" placeholder="0" step="1" min="0" name="kluczyk">
                        </fieldset>
                        <fieldset>
                            <legend>7. Data dostawy</legend>
                                <input type="date" name="data">
                        </fieldset>
                        <fieldset>
                            <legend>8. Preferowany czas dostawy</legend>
                                <input type="time" min="06:30" max="17:00" name="czas">
                        </fieldset>
                        <fieldset>
                            <legend>9. Uwagi do zamówienia</legend>
                                <textarea name="komentarz" id="komentarz" rows="4" cols="80" maxlength="25" placeholder="Twoje uwagi do zamówienia..."></textarea>
                        </fieldset>
                        <input id="submit" type="submit" value="Zamawiam">
                        <input id="reset" type="reset" value="Wyczyść formularz">
                    </div>
                </form>
            </article>
        </main>
        <aside>
            <div id="asd">
                <a href="https://coin-birds.com/?en=Ziczko" target="_blank">
                    <img src="https://coin-birds.com/images/promo/en/160x600.gif"
                    alt="Profit every 10 minutes!"></a>
            </div>               
        </aside>
        <footer id="footer">
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