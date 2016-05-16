<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cantidad_utilizada".
 *
 * @property integer $CU_ID
 * @property integer $SM_ID
 * @property integer $CU_CANTIDAD
 * @property string $CU_FECHA_INICIO
 * @property string $CU_FECHA_FINAL
 *
 * @property StockMateriales $sM
 */
class CantidadUtilizada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cantidad_utilizada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SM_ID'], 'required'],
            [['SM_ID', 'CU_CANTIDAD'], 'integer'],
            [['CU_FECHA_INICIO', 'CU_FECHA_FINAL'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CU_ID' => 'ID',
            'SM_ID' => 'Stock Material',
            'CU_CANTIDAD' => 'Cantidad',
            'CU_FECHA_INICIO' => 'Fecha Inicio',
            'CU_FECHA_FINAL' => 'Fecha Final',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSM()
    {
        return $this->hasOne(StockMateriales::className(), ['SM_ID' => 'SM_ID']);
    }
}
