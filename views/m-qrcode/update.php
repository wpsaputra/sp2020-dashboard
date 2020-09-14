<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MQrcode */

$this->title = 'Update M Qrcode: ' . $model->IDQR;
$this->params['breadcrumbs'][] = ['label' => 'M Qrcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IDQR, 'url' => ['view', 'id' => $model->IDQR]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mqrcode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
