<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MQrcode */

$this->title = 'Create M Qrcode';
$this->params['breadcrumbs'][] = ['label' => 'M Qrcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqrcode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
