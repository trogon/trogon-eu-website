<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PrivacyPolicy]].
 *
 * @see PrivacyPolicy
 */
class PrivacyPolicyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PrivacyPolicy[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PrivacyPolicy|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Filter only policy for given application key
     * @return PrivacyPolicy|array|null
     */
    public function appKey($appKey)
    {
        return $this->andWhere(['app_key' => $appKey]);
    }
}
