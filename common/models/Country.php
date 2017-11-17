<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property string $id
 * @property string $code
 * @property string $language
 * @property string $currency
 * @property string $name
 * @property string $currency_symbol
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'language', 'currency', 'name'], 'required'],
            [['code', 'language'], 'string', 'max' => 2],
            [['currency'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 52],
            [['currency_symbol'], 'string', 'max' => 7],
            [['code'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'language' => Yii::t('app', 'Language'),
            'currency' => Yii::t('app', 'Currency'),
            'name' => Yii::t('app', 'Name'),
            'currency_symbol' => Yii::t('app', 'Currency Symbol'),
        ];
    }
}
