<?php
class View
{
    public $rawData;
    private $data = array();

    public function setViewData($rawData)
    {
        $this->rawData = $rawData;
    }

    public function formatData()
    {
        $array = array();
        $array = explode(PHP_EOL, $this->rawData);
        foreach ($array as $elements) {
            array_push($this->data, explode(',', $elements));
        }
    }

    public function showCharts()
    {
        //google charts
?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" defer></script>
        <script type='text/javascript'>
            google.charts.load('current', {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Marka i model', 'Liczba zakupów'],
                    <?php
                    for ($i = 0; $i < sizeof($this->data); $i++) {
                        echo "[";
                        $row = $this->data[$i];
                        for ($j = 1; $j < sizeof($row); $j++) {
                            echo substr($row[$j], 1, -1);
                            if ($j < sizeof($row) - 1) {
                                echo ",";
                            }
                        }
                        echo "]";
                        if ($i < sizeof($this->data) - 1) {
                            echo ",";
                        }
                    }
                    ?>
                ]);

                var options = {
                    title: 'Statystyki sprzedaży',
                    is3D: true,
                    backgroundColor: {
                        fill: 'transparent'
                    },
                };

                var chart = new google.visualization.PieChart(document.getElementById('wykres'));
                chart.draw(data, options);
            }
        </script>
<?php
    }

    public function showTable()
    {
        echo '<table>
                    <thead>
                    <th>ID</th>
                    <th>Marka i model</th>
                    <th>Liczba zakupów</th>
                    </thead>
                    <tbody>';
        for ($i = 0; $i < sizeof($this->data); $i++) {
            echo "<tr>";
            $row = $this->data[$i];
            for ($j = 0; $j < sizeof($row); $j++) {
                echo "<td>" . substr($row[$j], 1, -1) . "</td>";
            }
            echo "</tr>";
        }
        echo        '</tbody>
            </table>';
    }



    public function showError($errorName)
    {
        echo $errorName;
    }
}
?>