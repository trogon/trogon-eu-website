<?php
namespace frontend\controllers;

use Yii;
use common\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Page controller
 */
class PageController extends Controller
{
    public function actionView($alias)
    {
		$model = $this->findModel($alias);

        return $this->render('view',[
			'model' => $model
		]);
    }

	/**
	 * Finds the Page model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $alias
	 * @return Page the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($alias)
	{
		if (($model = Page::findOne(['alias' => $alias])) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
