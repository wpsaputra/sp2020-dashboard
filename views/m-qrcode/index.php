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

    <div style="width: 100%; overflow-x: scroll;">
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
            [
                'attribute' => 'Penduduk_Total',
                'label' => 'Target Penduduk',
                'value' => 'Penduduk_Total'
            ],
            // 'Penduduk_Total',
            [
                'attribute' => '107a+107b',
                'label' => 'Penduduk Pencacahan (107a+107b)',
                // 'value' => 'batches.107a'
                // 'value' => function ($model) {
                //     // return $model->getBatches()["107a"]+ $model->getBatches()["107b"];
                //     return $model->getBatches()["107a"]+ $model->getBatches()["107b"];
                // },
                'value' => function ($model) {
                    // return $model->getBatches()["107a"]+ $model->getBatches()["107b"];
                    // return $model->getBatches();
                    // return json_encode($model::find()->one());
                    // return $model::find()->one();
                    // return json_encode($model->getBatches()->one()["107a"]+$model->getBatches()->one()["107b"]);
                    return $model->getBatches()->one()["107a"]+$model->getBatches()->one()["107b"];
                },
            ],
            // '107a',
            [
                'attribute' => '107a',
                'label' => '107a',
                'value' => 'batches.107a'
            ],
            [
                'attribute' => '107b',
                'label' => '107b',
                'value' => 'batches.107b'
            ],
            [
                'attribute' => '107c',
                'label' => '107c',
                'value' => 'batches.107c'
            ],
            [
                'attribute' => '107d',
                'label' => '107d',
                'value' => 'batches.107d'
            ],
            [
                'attribute' => '108a',
                'label' => '108a',
                'value' => 'batches.108a'
            ],
            [
                'attribute' => '108b',
                'label' => '108b',
                'value' => 'batches.108b'
            ],
            [
                'attribute' => '109a',
                'label' => '109a',
                'value' => 'batches.109a'
            ],
            [
                'attribute' => '109b',
                'label' => '109b',
                'value' => 'batches.109b'
            ],

            //'Keluarga_Total',
            //'flag_is_digunakan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    </div>



</div>
