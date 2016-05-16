<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property integer $PROVI_ID
 * @property string $PROVI_NOMBRE
 *
 * @property Ciudad[] $ciudads
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provincia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROVI_NOMBRE'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROVI_ID' => 'ID',
            'PROVI_NOMBRE' => 'Provincia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiudads()
    {
        return $this->hasMany(Ciudad::className(), ['PROVI_ID' => 'PROVI_ID']);
    }
}
