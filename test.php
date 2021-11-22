<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>charts</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>

<body>
    <div class="bx" style="display: flex; justify-content: center;width: 80%; margin: 0 auto;">
        <div id="container" style="width:100%; height:400px;"></div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const chart = Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Fruit Consumption'
            },
            xAxis: {
                categories: ['Apples', 'Bananas', 'Oranges']
            },
            yAxis: {
                title: {
                    text: 'Fruit eaten'
                }
            },
            series: [{
                name: 'Jane',
                data: [1, 0, 4]
            }, {
                name: 'John',
                data: [5, 7, 3]
            }, {
                name: 'Pankaj',
                data: [3, 5, 9]
            }]
        });
    });
    </script>
</body>

</html>