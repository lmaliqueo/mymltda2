<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_materiales".
 *
 * @property integer $PM_ID
 * @property integer $PRO_ID
 * @property string $PM_ESTADO
 * @property string $PM_DESCRIPCION
 * @property string $PM_FECHA
 * @property string $PM_TEXTO
 *
 * @property PedidoAdjunta[] $pedidoAdjuntas
 */
class PedidoMateriales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_materiales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PM_FECHA'], 'safe'],
            [['PM_DESCRIPCION'], 'string'],
            [['PM_ESTADO'], 'string', 'max' => 20],
            [['PM_TITULO'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PM_ID' => 'ID',
            'PM_ESTADO' => 'Estado',
            'PM_TITULO' => 'Título',
            'PM_FECHA' => 'Fecha',
            'PM_DESCRIPCION' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoAdjuntas()
    {
        return $this->hasMany(PedidoAdjunta::className(), ['PM_ID' => 'PM_ID']);
    }
}
