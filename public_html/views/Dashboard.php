

<?php
require '../../resources/config.php';
require $config["paths"]["model"].'get_dash_transactions.php';

function display_pie_chart($config){

?>
<!DOCTYPE HTML>
<html lang='en'>

<head>


<!-- *******************Main imports******************-->
<?php 
 //main_imports($config); 
 high_chart_import();
 
 ?>

<script>

$(document).ready(function () {

    // Build the chart
    Highcharts.chart('pie_chart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Monthly Expense Break Up'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Percentage',
            colorByPoint: true,
            data: [/*{
                name: 'Food',
                y: 15000.00
            }, {
                name: 'Utility Bills',
                y: 6500.00,
                sliced: true,
                selected: true
            }, {
                name: 'Transport',
                y: 2500.00
            }, {
                name: 'Other Expenses',
                y: 1000.00
            }*/
			<?php get_expense_type();?>
			]
        }]
		
		});
		});
		
		</script>
		
		<body>
              <div id='pie_chart' ></div>
        </body>
<?php }

function display_expense_vs_income($config){

$motnh_expense_arr=get_monthly_expense();


?>

<!DOCTYPE HTML>
<html lang='en'>

<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- *******************Main imports******************-->
<?php 
 //main_imports($config); 
 high_chart_import();
 
 ?>

<script>

$(document).ready(function () {

   Highcharts.chart('exp_inc', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Income VS Expense'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            <?php echo $motnh_expense_arr[0];?>
           
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount ($)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} $</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Income',
        data: [<?php echo $motnh_expense_arr[2];?>]

    },{
        name: 'Expense',
        data: [<?php echo $motnh_expense_arr[1];?>]

    }]
});
});
		
		</script>
		
		<body>
              <div id='exp_inc' ></div>
        </body>
		
		
<?php
}
?>		

		