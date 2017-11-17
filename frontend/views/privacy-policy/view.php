<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PrivacyPolicy */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Privacy Policy'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privacy-policy-view">


    <h1>Application <?= Html::encode($this->title) ?></h1>

    <h2 class="page-header">Privacy Policy</h2>

    <div><?= $model->content ?></div>

    <div><p class="text-right">Updated: <?= Yii::$app->formatter->format(Html::encode($model->updated_at), 'date') ?></p></div>

</div>
