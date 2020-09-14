<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MQrcodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Qrcodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqrcode-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create M Qrcode', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'IDQR',
            [
                'attribute' => 'IDQR',
                'label' => 'IDQR',
                'value' => 'IDQR'
            ],
            // 'IDSLS',
            // 'IDKEC',
            // 'IDDESA',
            // 'KDPROV',
            //'KDKAB',
            //'KDKEC',
            //'KDDESA',
            //'IDSLSNON',
            
            // 'NMPROV',
            // 'NMKAB',
            // 'NMKEC',
            // 'NMDESA',
            // 'NMSLSNON',
            // 'Penduduk_Total',
            
            [
                'attribute' => 'NMPROV',
                'label' => 'Provinsi',
                'value' => 'NMPROV'
            ],
            [
                'attribute' => 'NMKAB',
                'label' => 'Kabupaten',
                'value' => 'NMKAB'
            ],
            [
                'attribute' => 'NMKEC',
                'label' => 'Kecamatan',
                'value' => 'NMKEC'
            ],
            [
                'attribute' => 'NMDESA',
                'label' => 'Desa',
                'value' => 'NMDESA'
            ],
            [
                'attribute' => 'NMSLSNON',
                'label' => 'SLS',
                'value' => 'NMSLSNON'
            ],
            'Penduduk_Total',
            [
                'attribute' => 'lol',
                'label' => 'LOL',
                'value' => 'batch.IDQR'
            ],
            
            //'Keluarga_Total',
            //'flag_is_digunakan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
