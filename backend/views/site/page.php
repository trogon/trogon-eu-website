<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-page">

    <div class="body-content">

<?php if(empty($model->user_id)): ?>
		<div class="jumbotron">
			<h1><?= Yii::t('app', 'This page is not configured!') ?></h1>

			<p class="lead"><?= Yii::t('app', 'To configure this page you need go to admin panel!') ?></p>

			<p><a class="btn btn-lg btn-success" href="<?= Url::to(['/page/update', 'id' => $model->id]) ?>"><?= Yii::t('app', 'Edit this page') ?></a></p>
		</div>
<?php else: ?>

        <div class="row">
            <div class="col-lg-12">
<?php if(!empty($model->title)): ?>
                <h2><?= $model->title ?></h2>
<?php endif; ?>

                <p><?= $model->content ?></p>

            </div>
        </div>

<?php endif; ?>

    </div>
</div>
