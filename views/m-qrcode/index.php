<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MQrcodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Qrcode';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
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
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '107a')[0]+ArrayHelper::getColumn($model->batches, '107b')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],
    // '107a',
    [
        'attribute' => '107a',
        'label' => '107a',
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '107a')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],
    [
        'attribute' => '107b',
        'label' => '107b',
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '107b')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],
    [
        'attribute' => '107c',
        'label' => '107c',
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '107c')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],
    [
        'attribute' => '107d',
        'label' => '107d',
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '107d')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],
    [
        'attribute' => '108a',
        'label' => '108a',
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '108a')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],
    [
        'attribute' => '108b',
        'label' => '108b',
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '108b')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],
    [
        'attribute' => '109a',
        'label' => '109a',
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '109a')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],
    [
        'attribute' => '109b',
        'label' => '109b',
        'format' => 'raw',
        'value' => function ($model) {
            try {
                return json_encode(ArrayHelper::getColumn($model->batches, '109b')[0]);
            } catch (\Throwable $th) {
                return '<span class="not-set">(not set)</span>';
            }

        },
    ],

    //'Keluarga_Total',
    //'flag_is_digunakan',

    // ['class' => 'yii\grid\ActionColumn'],

    [  
        'class' => 'yii\grid\ActionColumn',
        // 'contentOptions' => ['style' => 'width:260px;'],
        'header'=>'Actions',
        // 'template' => '{view} {delete}',
        'template' => '{view}',
        'buttons' => [

            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-search"></span> View', $url, [
                            'title' => Yii::t('app', 'View'),
                            'class'=>'btn btn-primary btn-xs',                                  
                ]);
            },
        ],

        // 'urlCreator' => function ($action, $model, $key, $index) {
        //     if ($action === 'view') {
        //         $url ='/jobs/view?id='.$model->jobid;
        //         return $url;
        //     }
        // }

    ]
];


?>
<div class="mqrcode-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a('Create M Qrcode', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <div style="width: 100%; overflow-x: scroll;">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns
        ]); 
    ?>

    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns
    ]); ?>
    
    </div>



</div>
