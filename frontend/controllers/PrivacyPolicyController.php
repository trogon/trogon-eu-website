<?php

namespace frontend\controllers;

use Yii;
use common\models\PrivacyPolicy;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrivacyPolicyController implements the CRUD actions for PrivacyPolicy model.
 */
class PrivacyPolicyController extends Controller
{
    /**
     * Displays a single PrivacyPolicy model.
     * @param string $id
     * @return mixed
     */
    public function actionIndex($appKey)
    {
        return $this->render('view', [
            'model' => $this->findModel($appKey),
        ]);
    }

    /**
     * Finds the PrivacyPolicy model based on its application key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $appKey
     * @return PrivacyPolicy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($appKey)
    {
        if (($model = PrivacyPolicy::find()->appKey($appKey)->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
