<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PrivacyTerms */

$this->title = Yii::t('app', 'Create Privacy Terms');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Privacy Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privacy-terms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
