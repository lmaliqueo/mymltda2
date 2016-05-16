<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_adjunta".
 *
 * @property integer $PV_ID
 * @property integer $PM_ID
 * @property integer $SM_ID
 * @property integer $VI_CANTIDADMAT
 *
 * @property PedidoMateriales $pM
 * @property StockMateriales $sM
 */
class PedidoAdjunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_adjunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SM_ID'], 'required'],
            [['PM_ID', 'SM_ID', 'PA_CANTIDADMAT'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PA_ID' => 'ID',
            'PM_ID' => 'Pedido',
            'SM_ID' => 'Stock',
            'PA_CANTIDADMAT' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPM()
    {
        return $this->hasOne(PedidoMateriales::className(), ['PM_ID' => 'PM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSM()
    {
        return $this->hasOne(StockMateriales::className(), ['SM_ID' => 'SM_ID']);
    }
}
