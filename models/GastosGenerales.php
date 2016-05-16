<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gastos_generales".
 *
 * @property integer $GG_ID
 * @property integer $PRO_ID
 * @property string $GG_TIPO
 * @property string $GG_DESCRIPCION
 * @property integer $GG_COSTO
 *
 * @property Proyecto $pRO
 */
class GastosGenerales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gastos_generales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRO_ID'], 'required'],
            [['PRO_ID', 'GG_COSTO'], 'integer'],
            [['GG_TIPO'], 'string', 'max' => 20],
            [['GG_DESCRIPCION'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GG_ID' => 'ID',
            'PRO_ID' => 'Proyecto',
            'GG_TIPO' => 'Tipo de Gasto',
            'GG_DESCRIPCION' => 'Descripcion',
            'GG_COSTO' => 'Costo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRO()
    {
        return $this->hasOne(Proyecto::className(), ['PRO_ID' => 'PRO_ID']);
    }
}
