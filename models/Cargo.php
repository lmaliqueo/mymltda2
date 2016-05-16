<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargo".
 *
 * @property integer $CA_ID
 * @property string $CA_NOMBRECARGO
 * @property string $CA_DESCRIPCION
 *
 * @property Persona[] $personas
 */
class Cargo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CA_NOMBRECARGO', 'CA_DESCRIPCION'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CA_ID' => 'ID',
            'CA_NOMBRECARGO' => 'Cargo',
            'CA_DESCRIPCION' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['CA_ID' => 'CA_ID']);
    }
}
