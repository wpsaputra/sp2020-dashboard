<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MQrcode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mqrcode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IDQR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IDSLS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IDKEC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IDDESA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDPROV')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDKAB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDKEC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDDESA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IDSLSNON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NMPROV')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NMKAB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NMKEC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NMDESA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NMSLSNON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Penduduk_Total')->textInput() ?>

    <?= $form->field($model, 'Keluarga_Total')->textInput() ?>

    <?= $form->field($model, 'flag_is_digunakan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
