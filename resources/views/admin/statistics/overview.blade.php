<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <title>Overview sample Page</title>
</head>
<body>

    <canvas id="horizontal-bar"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

    <script>
        let URL = 'https://covid19stats.ph/api/stats/location';
        let BASE_SLUG = 'surigao-del-sur';

        fetch(URL)
            .then(response => response.json())
            .then(data => {
                let cities = [];
                let cityConfirmedCase = [];
                let cityRecovered = [];
                let cityDeaths = [];

                surigaoDelSurCities = data.cities.filter((city) => city.slug.includes(BASE_SLUG));
                surigaoDelSurCities.map((city) => {
                    cities.push(city.name.replace(', Surigao del Sur', ''));
                    cityConfirmedCase.push(city.total);
                    cityRecovered.push(city.recovered)
                    cityDeaths.push(city.deaths)
                })
                initChart(cities, cityConfirmedCase, cityRecovered, cityDeaths)
            });
        
        let initChart = (labels, confirmed, recovered, deaths) => {
            let ctx = document.getElementById('horizontal-bar').getContext('2d');
            window.chartColors = {
                red: 'rgb(255, 99, 132)',
                orange: 'rgb(255, 159, 64)',
                yellow: 'rgb(255, 205, 86)',
                green: 'rgb(75, 192, 192)',
                blue: 'rgb(54, 162, 235)',
                purple: 'rgb(153, 102, 255)',
                grey: 'rgb(201, 203, 207)'
            };

            var barChartData = {
                labels: labels,
                datasets: [{
                    label: 'Confirmed Case',
                    backgroundColor:window.chartColors.yellow,
                    data : confirmed
                }, {
                    label: 'Recovered',
                    backgroundColor: window.chartColors.green,
                    data : recovered,
                },
                {
                    label: 'Deaths',
                    backgroundColor: window.chartColors.red,
                    data : deaths,
                }]

            };


            var myBarChart = new Chart(ctx, {
                type: 'horizontalBar',
                data : barChartData,
            });
        };
    </script>
</body>
</html>