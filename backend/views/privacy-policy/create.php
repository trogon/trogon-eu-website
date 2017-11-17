<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PrivacyPolicy */

$this->title = Yii::t('app', 'Create Privacy Policy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Privacy Policy'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privacy-policy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
