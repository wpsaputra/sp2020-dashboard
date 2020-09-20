<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MQrcode */

$this->title = $model->IDQR;
$this->params['breadcrumbs'][] = ['label' => 'M Qrcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile(
    '@web/js/vertical-timeline.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$js = "$('#myTimeline').verticalTimeline({
    startLeft: false,
    alternate: true,
    animate: 'fade',
    arrows: false
});";

$this->registerJS($js);

$array_posisi = array(1=>'Penerimaan TU', 2=>'Penerimaan IPDS', 3=>'Entri Dokumen', 4=>'Validasi Dokumen', 5=>'Gudang Penyimpanan', 6=>'QC Subject Matter', 7=>'-');
$array_quote = array(1=>'Tahapan penerimaan dokumen SUTAS dari kabupaten oleh TU Provinsi.', 2=>'Tahapan penerimaan dokumen SUTAS dari TU Provinsi ke IPDS Provinsi.', 
3=>'Tahapan pengentrian dokumen SUTAS.', 4=>'Tahapan validasi dokumen SUTAS.', 5=>'Tahapan Gudang Penyimpanan.', 6=>'Tahapan QC Subject Matter.', 
7=>'Belum dilakukan tahapan penerimaan dokumen.');

$timeline_template = '
<div>
    <div class="date pull-right">?date?</div>
    <h2 style="padding:10px 20px;">Scan Dokumen</h2>
    <blockquote>107a = ?107a?</blockquote>
    <blockquote>107b = ?107b?</blockquote>
    <blockquote>107c = ?107c?</blockquote>
    <blockquote>107d = ?107d?</blockquote>
    <blockquote>108a = ?108a?</blockquote>
    <blockquote>108b = ?108b?</blockquote>
    <blockquote>109a = ?109a?</blockquote>
    <blockquote>109b = ?109b?</blockquote>
    <blockquote>(discan oleh ?penerima?)</blockquote>
</div>';

$timeline_template2 = '
<div>
    <div class="date pull-right">?date?</div>
    <h2 style="padding:10px 20px;">Scan Dokumen</h2>
    <blockquote>Dokumen belum pernah discan</blockquote>
    <blockquote>(discan oleh ?penerima?)</blockquote>
</div>';

?>

<div class="alert alert-info alert-dismissible" role="alert">
    <h2><strong>History Batch <?=$model->IDQR?></strong></pH1>
</div>

<div class="mqrcode-view">

    <?php 
    // DetailView::widget([
    //     'model' => $model,
    //     'attributes' => [
    //         'IDQR',
    //         'IDSLS',
    //         'IDKEC',
    //         'IDDESA',
    //         'KDPROV',
    //         'KDKAB',
    //         'KDKEC',
    //         'KDDESA',
    //         'IDSLSNON',
    //         'NMPROV',
    //         'NMKAB',
    //         'NMKEC',
    //         'NMDESA',
    //         'NMSLSNON',
    //         'Penduduk_Total',
    //         'Keluarga_Total',
    //         'flag_is_digunakan',
    //     ],
    // ]) 
    ?>

    <div id="myTimeline">
        <?php
            $arr_model_batch = ArrayHelper::toArray($model_batch);

            foreach ($model_batch as $key => $value) {
                $temp = $timeline_template;
                $temp = str_replace("?date?", DateTime::createFromFormat('Y-m-d H:i:s', $value->updated_date)->format('d M Y (H:i:s)'), $temp);
                // $temp = str_replace("?posisi?", $array_posisi[$value->id_posisi], $temp);
                // $temp = str_replace("?quote?", $array_quote[$value->id_posisi], $temp);
                // $temp = str_replace("?penerima?", $value->noHp->nama, $temp);
                $temp = str_replace("?107a?", $value["107a"], $temp);
                $temp = str_replace("?107b?", $value["107b"], $temp);
                $temp = str_replace("?107c?", $value["107c"], $temp);
                $temp = str_replace("?107d?", $value["107d"], $temp);
                $temp = str_replace("?108a?", $value["108a"], $temp);
                $temp = str_replace("?108b?", $value["108b"], $temp);
                $temp = str_replace("?109a?", $value["109a"], $temp);
                $temp = str_replace("?109b?", $value["109b"], $temp);
                $temp = str_replace("?penerima?", $value->petugas->nama, $temp);
                // $temp = str_replace("?l2?", $value->jumlah_l2, $temp);
                echo $temp;

            }

            if(count($arr_model_batch)==0){
                $temp = $timeline_template2;
                $temp = str_replace("?date?", DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"))->format('d M Y (H:i:s)'), $temp);
                $temp = str_replace("?posisi?", $array_posisi[7], $temp);
                $temp = str_replace("?quote?", $array_quote[7], $temp);
                $temp = str_replace("?penerima?", "-", $temp);
                $temp = str_replace("?l1?", "-", $temp);
                $temp = str_replace("?l2?", "-", $temp);
                echo $temp;
            }

        ?>

    </div>

</div>
