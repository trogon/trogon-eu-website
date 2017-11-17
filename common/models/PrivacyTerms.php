<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%privacy_terms}}".
 *
 * @property string $id
 * @property string $app_key
 * @property string $name
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 */
class PrivacyTerms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%privacy_terms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_key', 'name', 'content', 'created_at'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['app_key', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'app_key' => Yii::t('app', 'App Key'),
            'name' => Yii::t('app', 'Name'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return PrivacyTermsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PrivacyTermsQuery(get_called_class());
    }
}
