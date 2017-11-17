<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PrivacyTerms]].
 *
 * @see PrivacyTerms
 */
class PrivacyTermsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PrivacyTerms[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PrivacyTerms|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Filter only terms for given application key
     * @return PrivacyTerms|array|null
     */
    public function appKey($appKey)
    {
        return $this->andWhere(['app_key' => $appKey]);
    }
}
