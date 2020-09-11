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
// $jumlah_penduduk = Yii::$app->db->createCommand('SELECT a.*, b.* FROM (
//     SELECT a.IDQR, MAX(a.updated_date) AS max_updated_date
//     FROM batch a
//     GROUP BY a.IDQR
// ) AS a LEFT JOIN batch b
// ON a.IDQR=b.IDQR AND a.max_updated_date=b.updated_date')->queryScalar(); //todo 107a + 107b

$jumlah_penduduk = Yii::$app->db->createCommand('SELECT SUM(c.107a)+SUM(c.107b) FROM 
(
SELECT a.*, b.107a, b.107b, b.107c, b.107d FROM (
    SELECT a.IDQR, MAX(a.updated_date) AS max_updated_date
    FROM batch a
    GROUP BY a.IDQR
) AS a LEFT JOIN batch b
ON a.IDQR=b.IDQR AND a.max_updated_date=b.updated_date
) AS c
')->queryScalar(); //todo 107a + 107b

$jumlah_penduduk_belum = $target_penduduk-$jumlah_penduduk;

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
            text: 'Jumlah Penduduk yang Telah dicacah per Target Penduduk [$jumlah_penduduk / $target_penduduk]'
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
                name: 'Target Penduduk yang belum discan',
                y: $jumlah_penduduk_belum,
                sliced: true,
                selected: true
            }, {
                name: 'Target Penduduk',
                y: $jumlah_penduduk
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
    var chart3 = Highcharts.chart('chart3', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [
                'Buton',
                'Muna',
                'Konawe',
                'Kolaka',
                'Konawe Selatan',
                'Bombana',
                'Wakatobi',
                'Kolaka Utara',
                'Buton Utara',
                'Konawe Utara',
                'Kolaka Timur',
                'Kendari',
                'Baubau'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, 50]
    
        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3, 50]
    
        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2, 50]
    
        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1, 50]
    
        }]
    });
    
});


EOT_JS_CODE, View::POS_END
);

?>
<div class="site-index">

    <div class="jumbotron">
        <h3>Progress SP2020 BPS Provinsi Sulawesi Tenggara!</h3>

        <!-- <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> -->
    </div>

    <div class="body-content">

        <div class="row" style="margin: 10px 0px;">
            <div id="chart1" class="col-lg-6">
            </div>
            <div id="chart2" class="col-lg-6">
            </div>
        </div>
        <div class="row" style="margin: 10px 0px;">
            <div id="chart3" class="col-lg-12">
            </div>
        </div>

    </div>
</div>
