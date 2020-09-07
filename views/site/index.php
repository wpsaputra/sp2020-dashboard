<?php

/* @var $this yii\web\View */

// use yii\base\View;

use yii\web\View;

$this->title = 'SP2020 Dashboard';
$this->registerJsFile(
    '@web/js/highcharts.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

$target_sls = Yii::$app->db->createCommand('SELECT COUNT(*) FROM m_qrcode as count_alias')->queryScalar();
$jumlah_scan = Yii::$app->db->createCommand('SELECT COUNT(Distinct IDQR) FROM batch as count_alias')->queryScalar();
$jumlah_belum = $target_sls - $jumlah_scan; 

$target_penduduk = Yii::$app->db->createCommand('SELECT SUM(Penduduk_Total) FROM m_qrcode')->queryScalar();
$jumlah_penduduk = Yii::$app->db->createCommand('SELECT a.*, b.* FROM (
    SELECT a.IDQR, MAX(a.updated_date) AS max_updated_date
    FROM batch a
    GROUP BY a.IDQR
) AS a LEFT JOIN batch b
ON a.IDQR=b.IDQR AND a.max_updated_date=b.updated_date')->queryScalar(); //todo 107a + 107b

$this->registerJs( <<< EOT_JS_CODE
  // JS code here
document.addEventListener('DOMContentLoaded', function () {
    var chart1 = Highcharts.chart('chart1', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jumlah Dokumen discan per Target SLS [$jumlah_scan / $target_sls] '
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Target SLS yang belum discan',
                y: $jumlah_belum,
                sliced: true,
                selected: true
            }, {
                name: 'Scan Dokumen',
                y: $jumlah_scan
            }]
        }],
        'colors': [
            // '#7cb5ec',

            '#f7a35c',
            '#90ed7d',
            '#3A3A4F',
            // '#434348',
        ],
    });
});


EOT_JS_CODE, View::POS_END
);

$this->registerJs( <<< EOT_JS_CODE
  // JS code here
document.addEventListener('DOMContentLoaded', function () {
    var chart2 = Highcharts.chart('chart2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jumlah Penduduk yang Telah dicacah per Target Penduduk [ / $target_penduduk]'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Target SLS yang belum discan',
                y: $jumlah_belum,
                sliced: true,
                selected: true
            }, {
                name: 'Scan Dokumen',
                y: $jumlah_scan
            }]
        }],
        'colors': [
            // '#7cb5ec',

            '#f7a35c',
            '#90ed7d',
            '#3A3A4F',
            // '#434348',
        ],
    });
});


EOT_JS_CODE, View::POS_END
);

// $this->registerJs( <<< EOT_JS_CODE
//   // JS code here
// document.addEventListener('DOMContentLoaded', function () {
//     var myChart = Highcharts.chart('chart2', {
//         chart: {
//             type: 'bar'
//         },
//         title: {
//             text: 'Fruit Consumption'
//         },
//         xAxis: {
//             categories: ['Apples', 'Bananas', 'Oranges']
//         },
//         yAxis: {
//             title: {
//                 text: 'Fruit eaten'
//             }
//         },
//         series: [{
//             name: 'Jane',
//             data: [1, 0, 4]
//         }, {
//             name: 'John',
//             data: [5, 7, 3]
//         }]
//     });
// });


// EOT_JS_CODE, View::POS_END
// );
?>
<div class="site-index">

    <div class="jumbotron">
        <h3>Progress SP2020 BPS Provinsi Sulawesi Tenggara!</h3>

        <!-- <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> -->
    </div>

    <div class="body-content">

        <div class="row">
            <div id="chart1" class="col-lg-6">
            </div>
            <div id="chart2" class="col-lg-6">
            </div>
        </div>

    </div>
</div>
