<?php

/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\helpers\Url;

$this->title = 'SP2020 Dashboard';
$this->registerJsFile(
    '@web/js/highcharts.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

$target_sls = Yii::$app->db->createCommand('SELECT COUNT(*) FROM m_qrcode as count_alias')->queryScalar();
$jumlah_scan = Yii::$app->db->createCommand('SELECT COUNT(Distinct IDQR) FROM batch as count_alias')->queryScalar();
$jumlah_belum = $target_sls - $jumlah_scan; 

$target_penduduk = Yii::$app->db->createCommand('SELECT SUM(Penduduk_Total) FROM m_qrcode')->queryScalar();
$jumlah_penduduk = Yii::$app->db->createCommand('SELECT SUM(c.107a)+SUM(c.107b) FROM 
(
SELECT a.*, b.107a, b.107b, b.107c, b.107d FROM (
    SELECT a.IDQR, MAX(a.updated_date) AS max_updated_date
    FROM batch a
    GROUP BY a.IDQR
) AS a LEFT JOIN batch b
ON a.IDQR=b.IDQR AND a.max_updated_date=b.updated_date
) AS c
')->queryScalar();

$jumlah_penduduk_belum = $target_penduduk-$jumlah_penduduk;

$script = <<< JS
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
            credits: {
                enabled: false
            },
        });
    });
JS;

$this->registerJs($script, View::POS_END);

$script2 = <<< JS
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
            credits: {
                enabled: false
            },
        });
    });
JS;
$this->registerJs($script2, View::POS_END);


$target_sls_per_kab = Yii::$app->db->createCommand('SELECT KDKAB, COUNT(*) FROM m_qrcode GROUP BY KDKAB ORDER BY KDKAB')->queryAll();
$arr_target_sls_per_kab =  array();
foreach ($target_sls_per_kab as $key => $value) {
    $arr_target_sls_per_kab[] = $value["COUNT(*)"];
}

$arr_target_sls_per_kab = json_encode($arr_target_sls_per_kab);
$arr_target_sls_per_kab = str_replace('"', "", $arr_target_sls_per_kab);
// echo($arr_target_sls_per_kab);

$realisasi_sls_per_kab = Yii::$app->db->createCommand('SELECT SUBSTRING(IDQR, 1, 4) AS KDKAB, COUNT(DISTINCT IDQR) AS JUMLAH FROM batch GROUP BY SUBSTRING(IDQR, 1, 4)')->queryAll();
$arr_realisasi_sls_per_kab =  array();
$arr_realisasi_sls_per_kab["7401"] =  0;
$arr_realisasi_sls_per_kab["7402"] =  0;
$arr_realisasi_sls_per_kab["7403"] =  0;
$arr_realisasi_sls_per_kab["7404"] =  0;
$arr_realisasi_sls_per_kab["7405"] =  0;
$arr_realisasi_sls_per_kab["7406"] =  0;
$arr_realisasi_sls_per_kab["7407"] =  0;
$arr_realisasi_sls_per_kab["7408"] =  0;
$arr_realisasi_sls_per_kab["7409"] =  0;
$arr_realisasi_sls_per_kab["7410"] =  0;
$arr_realisasi_sls_per_kab["7411"] =  0;
$arr_realisasi_sls_per_kab["7412"] =  0;
$arr_realisasi_sls_per_kab["7413"] =  0;
$arr_realisasi_sls_per_kab["7414"] =  0;
$arr_realisasi_sls_per_kab["7415"] =  0;
$arr_realisasi_sls_per_kab["7471"] =  0;
$arr_realisasi_sls_per_kab["7472"] =  0;

foreach ($realisasi_sls_per_kab as $key => $value) {
    $arr_realisasi_sls_per_kab[$value["KDKAB"]] = $value["JUMLAH"];
}

$arr_realisasi_sls_per_kab = json_encode(array_values($arr_realisasi_sls_per_kab));
$arr_realisasi_sls_per_kab = str_replace('"', "", $arr_realisasi_sls_per_kab);
// print_r($arr_realisasi_sls_per_kab);

$target_penduduk_per_kab = Yii::$app->db->createCommand('SELECT KDKAB, SUM(Penduduk_Total) FROM m_qrcode GROUP BY KDKAB')->queryAll();
$arr_target_penduduk_per_kab =  array();
foreach ($target_penduduk_per_kab as $key => $value) {
    $arr_target_penduduk_per_kab[] = $value["SUM(Penduduk_Total)"];
}

$arr_target_penduduk_per_kab = json_encode($arr_target_penduduk_per_kab);
$arr_target_penduduk_per_kab = str_replace('"', "", $arr_target_penduduk_per_kab);
// print_r($arr_target_penduduk_per_kab);


$jumlah_penduduk_per_kab = Yii::$app->db->createCommand('SELECT SUBSTRING(c.IDQR, 1,4) AS KDKAB, SUM(c.107a)+SUM(c.107b) AS JUMLAH FROM 
(
SELECT a.*, b.107a, b.107b, b.107c, b.107d FROM (
    SELECT a.IDQR, MAX(a.updated_date) AS max_updated_date
    FROM batch a
    GROUP BY a.IDQR
) AS a LEFT JOIN batch b
ON a.IDQR=b.IDQR AND a.max_updated_date=b.updated_date
) AS c GROUP BY SUBSTRING(c.IDQR, 1,4)
')->queryAll();

$arr_realisasi_jumlah_penduduk_per_kab =  array();
$arr_realisasi_jumlah_penduduk_per_kab["7401"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7402"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7403"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7404"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7405"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7406"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7407"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7408"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7409"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7410"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7411"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7412"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7413"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7414"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7415"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7471"] =  0;
$arr_realisasi_jumlah_penduduk_per_kab["7472"] =  0;

foreach ($jumlah_penduduk_per_kab as $key => $value) {
    $arr_realisasi_jumlah_penduduk_per_kab[$value["KDKAB"]] = $value["JUMLAH"];
}
$arr_realisasi_jumlah_penduduk_per_kab = json_encode(array_values($arr_realisasi_jumlah_penduduk_per_kab));
$arr_realisasi_jumlah_penduduk_per_kab = str_replace('"', "", $arr_realisasi_jumlah_penduduk_per_kab);

$url = json_encode(Url::to(['m-qrcode/index', 'MQrcodeSearch[NMKAB]'=>'']));

$script3 = <<< JS
    document.addEventListener('DOMContentLoaded', function () {
        var chart3 = Highcharts.chart('chart3', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Target Realisasi Dokumen per Kabupaten'
            },
            // subtitle: {
            //     text: 'Source: WorldClimate.com'
            // },
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
                    'Konawe Kepulauan',
                    'Muna Barat',
                    'Buton Tengah',
                    'Buton Selatan',
                    'Kendari',
                    'Baubau'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah SLS'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:1f} SLS</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                },
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                // alert('Category: ' + this.category + ', value: ' + this.y);
                                // location.href = 'https://en.wikipedia.org/wiki/'
                                // location.href = 'https://sultradata.com/'+$url
                                location.href = $url + this.category
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'Target SLS',
                // data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, 50]
                data: $arr_target_sls_per_kab
        
            }, {
                name: 'Realisasi SLS',
                // data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3, 50]
                data: $arr_realisasi_sls_per_kab
        
            }],
            credits: {
                enabled: false
            },
        });
        
    });
    
    
JS;
$this->registerJs($script3, View::POS_END);

$script4 = <<< JS
    document.addEventListener('DOMContentLoaded', function () {
        var chart3 = Highcharts.chart('chart4', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Target Realisasi Penduduk per Kabupaten'
            },
            // subtitle: {
            //     text: 'Source: WorldClimate.com'
            // },
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
                    'Konawe Kepulauan',
                    'Muna Barat',
                    'Buton Tengah',
                    'Buton Selatan',
                    'Kendari',
                    'Baubau'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Penduduk'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:1f} Jiwa</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                },
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                // alert('Category: ' + this.category + ', value: ' + this.y);
                                // location.href = 'https://en.wikipedia.org/wiki/'
                                // location.href = 'https://sultradata.com/'+$url
                                location.href = $url + this.category
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'Target Penduduk',
                // data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2, 50]
                data: $arr_target_penduduk_per_kab
        
            }, {
                name: 'Realisasi Penduduk',
                // data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1, 50]
                data: $arr_realisasi_jumlah_penduduk_per_kab
        
            }],
            credits: {
                enabled: false
            },
        });
        
    });
JS;
$this->registerJs($script4, View::POS_END);



?>



<div class="site-index">

    <div class="jumbotron">
        <h3>Progress SP2020 BPS Provinsi Sulawesi Tenggara!</h3>
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
        <div class="row" style="margin: 10px 0px;">
            <div id="chart4" class="col-lg-12">
            </div>
        </div>

    </div>
</div>
