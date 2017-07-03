<?php
include_once '../konfiguracija.php';

if(!isset($_SESSION["logiran"])){
	header("location: " . $putAplikacije . "Javno/login.php?nemateOvlasti");
	exit;
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../Predlosci/glava.php';
		?>
	</head>
	<body>
		<header>
			<?php
			include_once '../Predlosci/zaglavlje.php';
			?>
			<?php
				include_once '../Predlosci/izbornik.php';
			?>
		</header>

		<div class="row">
			<div class="large-12 columns">
				<div class="callout">
					<div class="row">
						<div class="large-6 columns">
							<div id="lijevi"></div>
						</div>
						<div class="large-6 columns">
							<div id="desni"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

			<?php include_once '../Predlosci/podnozje.php';?>
			<?php include_once '../Predlosci/skripte.php';?>
			<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script>
			Highcharts.chart('lijevi', {
			
			    title: {
			        text: 'Broj upisanih polaznika po godinama'
			    },
			
			    yAxis: {
			        title: {
			            text: 'Broj polaznika'
			        }
			    },
			    legend: {
			        layout: 'vertical',
			        align: 'right',
			        verticalAlign: 'middle'
			    },
			
			    plotOptions: {
			        series: {
			            pointStart: 2010
			        }
			    },
			
			    series: [{
			        name: 'Polaznici',
			        data: [85, 47, 59, 56, 88, 78]
			    }]
			
			});
			
			
			
			//desni
			Highcharts.chart('desni', {
			    chart: {
			        plotBackgroundColor: null,
			        plotBorderWidth: null,
			        plotShadow: false,
			        type: 'pie'
			    },
			    title: {
			        text: 'Broj polaznika po grupama'
			    },
			    tooltip: {
			        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			    },
			    plotOptions: {
			        pie: {
			            allowPointSelect: true,
			            cursor: 'pointer',
			            dataLabels: {
			                enabled: true,
			                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                style: {
			                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                }
			            }
			        }
			    },
			    series: [{
			        name: 'Grupe',
			        colorByPoint: true,
			        data: [{
			            name: 'WP15',
			            y: 20
			        }, {
			            name: 'J16',
			            y: 12,
			            sliced: true,
			            selected: true
			        }, {
			            name: 'SR',
			            y: 4
			        }, {
			            name: 'WD12',
			            y: 12
			        }]
			    }]
			});
		</script>
	</body>
</html>
