<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MQrcodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mqrcode-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IDQR') ?>

    <?= $form->field($model, 'IDSLS') ?>

    <?= $form->field($model, 'IDKEC') ?>

    <?= $form->field($model, 'IDDESA') ?>

    <?= $form->field($model, 'KDPROV') ?>

    <?php // echo $form->field($model, 'KDKAB') ?>

    <?php // echo $form->field($model, 'KDKEC') ?>

    <?php // echo $form->field($model, 'KDDESA') ?>

    <?php // echo $form->field($model, 'IDSLSNON') ?>

    <?php // echo $form->field($model, 'NMPROV') ?>

    <?php // echo $form->field($model, 'NMKAB') ?>

    <?php // echo $form->field($model, 'NMKEC') ?>

    <?php // echo $form->field($model, 'NMDESA') ?>

    <?php // echo $form->field($model, 'NMSLSNON') ?>

    <?php // echo $form->field($model, 'Penduduk_Total') ?>

    <?php // echo $form->field($model, 'Keluarga_Total') ?>

    <?php // echo $form->field($model, 'flag_is_digunakan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
