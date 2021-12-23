<!DOCTYPE html>
<html lang="pl">
<?php
function setMyCookie($cookieName, $cookieValue, $cookieExpireDate)
{
    setcookie($cookieName, $cookieValue, time() + ($cookieExpireDate * 86400), "/");
}

function readMyCookie($cookieName)
{
    if (!isset($_COOKIE[$cookieName])) {
        return null;
    } else {
        return $_COOKIE[$cookieName];
    }
}

function deleteMyCookie($cookieName)
{
    if (isset($_COOKIE[$cookieName])) {
        unset($_COOKIE[$cookieName]);
        setcookie($cookieName, null, -1, '/');
        return true;
    } else {
        return false;
    }
}

session_start();
if (session_status() == 2) {
    if (isset($_POST['logout'])) {
        session_destroy();
        deleteMyCookie("user");
    } else if (isset($_POST['login'])) {
        $_SESSION['user'] = $_POST['Nazwa'];
        setMyCookie("user", $_SESSION['user'], 1);
    } else if (!isset($_SESSION['user'])) {
        session_destroy();
        deleteMyCookie("user");
    }
}
if (session_status() == 1) {
    if (isset($_POST['login'])) {
        session_start();
        $_SESSION['user'] = $_POST['Nazwa'];
        setMyCookie("user", $_SESSION['user'], 1);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout'])) {
    logout();
}
function logout()
{
    $flag = 0;
    setMyCookie("flag", $flag, 1);
    echo ("<meta http-equiv='refresh' content='1'>");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon samochodowy</title>
    <link href="images/sport-car-1768.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="style.css">
    <noscript>Twoja przeglądarka nie wspiera lub ma wyłączoną obsługę JavaScript</noscript>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script defer src="./xml/skryptMapy.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVMG5B8JrvyGFtsYFDU9fJqfcgY4fwAT4&callback=initMap&v=weekly"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body onload="odwiedziny()">
    <header class="header">
        <svg width="100" height="100">
            <circle cx="50" cy="50" r="40" stroke="goldenrod" stroke-width="4" fill="gold" />
            <text fill="goldenrod" text-weight="bold" font-size="18" font-family="Verdana" x="12" y="55">AutoSell</text>
        </svg>
        <h1 class="h1" id="header">Salon samochodowy AutoSell</h1>
    </header>
    <div class="container">
        <aside class="asideL">
            <nav id="links">
                <h2 class="navigation-name">MENU</h2>
                <nav id='navMenu'>
                    <ul>
                    </ul>
                </nav>

                <div id="lang_selection"></div>
                <p id="counter">
                    Witam Cię po raz pierwszy na tej stronie.
                </p>
                <section id="logowanie">
                    <?php
                    $flag = readMyCookie("flag");
                    if ($flag == 0) {
                        echo '<a href="login.php">Logowanie</a><br><br><br><br>';
                    } ?>

                    <form action="index.php" method="post">
                        <?php
                        $flag = readMyCookie("flag");
                        if ($flag == 1) {
                            echo ' <a href="statystyki.php">Statystyki</a><br><br>';
                            echo "<input type='submit' name='logout' value='Wyloguj' />";
                        }

                        ?>
                    </form>
                    <?php
                    // if (session_status() == 2 && isset($_SESSION['user'])) {
                    //     echo "Witaj " . (readMyCookie("user") ? readMyCookie("user") : $_SESSION['user']) . "!";
                    // }
                    // 
                    ?>
                    <!-- <form action="index.php" method="post"> -->
                    <?php
                    //     if (session_status() == 2) {
                    //         echo "<input type='submit' name='logout' value='Wyloguj' />";
                    //     } else {
                    //         echo "<input type='textfield' name='Nazwa' style='margin-bottom:5px' minlength='3' placeholder='Nazwa'/>";
                    //         echo "<input type='submit' name='login' value='Zaloguj' />";
                    //     }
                    ?>

                </section>
                <section>

                </section>
            </nav>
        </aside>
        <aside class="asideR" id="asideR1">
            <h2>Dane Kontaktowe</h2>
            <nav id="asideR">
                Right menu
            </nav>
        </aside>
        <main class="main">
            <section>
                <h2>Oferta samochodów</h2>
                <table>
                    <thead class="thead">
                        <tr>
                            <th width="100">
                                <div><b>Marka</b></div>
                            </th>
                            <th width="100">
                                <div><b>Model</b></div>
                            </th>
                            <th width="100">
                                <div><b>Typ nadwozia</b></div>
                            </th>
                            <th width="100" colspan="3">
                                <div><b>Wymiary</b></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <tr>
                            <td>Peugeot</td>
                            <td>206</td>
                            <td>Hatchback</td>
                            <td>3822 mm</td>
                            <td>1652 mm</td>
                            <td>1426 mm</td>
                        </tr>
                        <tr>
                            <td>BMW</td>
                            <td>E60</td>
                            <td>Sedan</td>
                            <td>4841 mm</td>
                            <td>1846 mm</td>
                            <td>1468 mm</td>
                        </tr>
                        <tr>
                            <td>Citroen</td>
                            <td>c3</td>
                            <td>Hatchback</td>
                            <td>3850 mm</td>
                            <td>1667 mm</td>
                            <td>1519 mm</td>
                        </tr>
                        <tr>
                            <td>Toyota</td>
                            <td>Corolla</td>
                            <td>Kombi</td>
                            <td>4650 mm</td>
                            <td>1790 mm</td>
                            <td>1435 mm</td>
                        </tr>
                    </tbody>
            </section>
            </table>
            <section>
                <h2>Modele</h2>
                <table class="table2" id='table2'>
                    <thead class="thead"></thead>
                    <tbody class="tbody"></tbody>
                </table>
            </section>
            <section>
                <h2>Galeria</h2>
                <div style="display: flex; flex-direction: row; justify-content: center;">
                    <button id="lButton">&#8592;</button>
                    <img id="mojaGaleria" style='max-width: 50vw;' src="images/Peugeot.jpg" alt="Peugeot 206" />
                    <button id="rButton">&#8594;</button>
                </div>

                <div id="podpis" style="text-align: center;">Peugeot 206</div>
                <!-- <img width="270px" height="190px" src="images/BMW.jpg" alt="BMW E60">
                <img width="270px" height="190px" src="images/Citroen.jpg" alt="Citroen c3">
                <img width="270px" height="190px" src="images/Toyota.jpg" alt="Toyota Corolla"> -->
            </section>
            <section>
                <h2>Video</h2>
                <div style="display: flex; flex-direction: row; justify-content: center;">
                    <video class="video" width="270px" height="240px" autoplay muted controls loop>
                        <source src="videos/Peugeot.mp4" type="video/mp4">Alternatywny tekst w razie nieobsługiwania HTML
                        Video.
                    </video>
                    <video class="video" width="270px" height="240px" autoplay muted controls loop>
                        <source src="videos/BMW.mp4" type="video/mp4">Alternatywny tekst w razie nieobsługiwania HTML
                        Video.
                    </video>
                    <video class="video" width="270px" height="240px" autoplay muted controls loop>
                        <source src="videos/Citroen.mp4" type="video/mp4">Alternatywny tekst w razie nieobsługiwania HTML
                        Video.
                    </video>
                    <video class="video" width="270px" height="240px" autoplay muted controls loop>
                        <source src="videos/Toyota.webm" type="video/webm">Alternatywny tekst w razie nieobsługiwania HTML
                        Video.
                    </video>
                </div>

            </section>
            <section>
                <h2>Sieć salonów</h2>
                <div id="map" style="width: auto; height: 50vh; border-radius: 10px; "></div>
            </section>
            <section class="opinie">
                <h2>Opinie</h2>
                <div>
                    <article class="opinia">
                        <h3>Opinia 1</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consectetur impedit tempore ratione
                            veniam quod. Corrupti corporis delectus sequi quidem repellendus asperiores expedita porro
                            nobis, animi tenetur quisquam at consequuntur consequatur.</p>
                    </article>

                    <article class="opinia">
                        <h3>Opinia 2</h3>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores, animi vero ipsam non quae
                            fuga provident iusto repellendus obcaecati incidunt debitis beatae delectus odio facilis,
                            laborum quisquam veritatis voluptate? Similique?</p>
                    </article>

                    <article class="opinia">
                        <h3>Opinia 3</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, dolorem officia.
                            Aliquid delectus praesentium atque quasi blanditiis velit eaque reiciendis molestiae
                            dignissimos, eum et vero fugiat architecto magni! Reiciendis, mollitia?</p>
                    </article>

                    <article class="opinia">
                        <h3>Opinia 4</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque illo magnam, aliquam quia
                            deleniti cum repellat sit magni. Magni dolore unde nulla odio dolor, expedita porro eius
                            accusamus deleniti quibusdam!</p>
                    </article>

                    <article class="opinia">
                        <h3>Opinia 5</h3>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non, veritatis dolorum. Sed ut,
                            minima vel ad nostrum architecto aperiam quidem alias atque eos aliquam mollitia
                            dignissimos. Explicabo quis accusantium a.</p>
                    </article>

                </div>
            </section>
            <section id="links">
                <h2>Przydatne linki</h2>
                <div>
                    <div id="media1"></div>
                    <div id="media2"></div>
                    <a class="link" href="#top" style="float: left">Wróć na górę</a>
                </div>

            </section>
        </main>

    </div>

    <footer class="footer">
        <p id="stopka">Copyright &copy; <span id="year"></span>, OM</p>
    </footer>
    <script src="./script.js"></script>
    <script src="./xml/scriptLang.js"></script>
    <script src="./carouselGallery.js"></script>
    <?php
    require_once('secure.php');
    ?>
</body>

</html>