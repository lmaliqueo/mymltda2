<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaccion_materiales".
 *
 * @property integer $TM_ID
 * @property integer $SM_ID
 * @property string $TM_FECHACOMPRA
 * @property integer $TM_PRECIO
 * @property integer $TM_CANTIDAD
 *
 * @property MatProvAdquirido[] $matProvAdquiridos
 * @property StockMateriales $sM
 */
class TransaccionMateriales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaccion_materiales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SM_ID'], 'required'],
            [['SM_ID', 'TM_PRECIO', 'TM_CANTIDAD'], 'integer'],
            [['TM_FECHACOMPRA'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TM_ID' => 'ID',
            'SM_ID' => 'Stock Material',
            'TM_FECHACOMPRA' => 'Fecha Compra',
            'TM_PRECIO' => 'Precio',
            'TM_CANTIDAD' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatProvAdquiridos()
    {
        return $this->hasMany(MatProvAdquirido::className(), ['TM_ID' => 'TM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSM()
    {
        return $this->hasOne(StockMateriales::className(), ['SM_ID' => 'SM_ID']);
    }
}
