<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 150]) ?>

	<?= $form->field($model, 'content')->widget(Redactor::className(), [
		'clientOptions' => [
			'buttonsHide' => ['outdent', 'indent'],
			'buttonSource' => true,
			'plugins' => ['fontcolor', 'filemanager', 'imagemanager', 'video'],
			'minHeight' => 300,
		]
	])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
