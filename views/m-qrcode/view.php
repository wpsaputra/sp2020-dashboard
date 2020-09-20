<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MQrcode */

$this->title = $model->IDQR;
$this->params['breadcrumbs'][] = ['label' => 'M Qrcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mqrcode-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IDQR',
            'IDSLS',
            'IDKEC',
            'IDDESA',
            'KDPROV',
            'KDKAB',
            'KDKEC',
            'KDDESA',
            'IDSLSNON',
            'NMPROV',
            'NMKAB',
            'NMKEC',
            'NMDESA',
            'NMSLSNON',
            'Penduduk_Total',
            'Keluarga_Total',
            'flag_is_digunakan',
        ],
    ]) ?>

</div>
