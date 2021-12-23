<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon samochodowy - Statystyki</title>
    <link href="images/sport-car-1768.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="style2.css">
    <noscript>Twoja przeglądarka nie wspiera lub ma wyłączoną obsługę JavaScript</noscript>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
        }

        thead {
            background-color: wheat;
        }

        tbody>tr:nth-child(odd) {
            background-color: #0781fc;
        }

        tbody>tr:nth-child(even) {
            background-color: #fca80d;
        }
    </style>
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
            <nav>
                <h3 class="navigation-name">MENU</h3>
                <ul>
                    <li><a class="link" href="index.php">Strona główna</a></li>
                    <li><a class="link" href="samochody.html">Samochody</a></li>
                    <li><a class="link" href="link2.html">Link 2</a></li>
                    <li><a class="link" href="kontakt.html">Kontakt</a></li>
                    <li><a class="link" href="oStronie.html">O stronie</a></li>
                </ul>
            </nav>
        </aside>
        <aside class="asideR" id="asideR">
            <nav>
                Right menu
            </nav>
        </aside>
        <main class="main">
            <section>
                <h2>Statystyki</h2>
                <div>
                    <?php
                    if (file_exists('Controller/statisticController.php')) {
                        require_once('Controller/statisticController.php');
                    }
                    ?>
                </div>

                <!-- 
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load("current", {
                        packages: ["corechart"]
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Work', 11],
                            ['Eat', 2],
                            ['Commute', 2],
                            ['Watch TV', 2],
                            ['Sleep', 7]
                        ]);

                        var options = {
                            title: 'My Daily Activities',
                            is3D: true,
                            backgroundColor: {
                                fill: 'transparent'
                            },
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                        chart.draw(data, options);
                    }
                </script>

                <div id="piechart_3d" style="width: 900px; height: 500px;"></div> -->
                <div id="wykres" style="width: 900px; height: 500px;"></div>
            </section>
        </main>

    </div>

    <footer class="footer">
        <p id="stopka">Copyright &copy; <span id="year"></span>, OM</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>