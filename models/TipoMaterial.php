<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_material".
 *
 * @property integer $TMA_ID
 * @property string $TMA_NOMBRE
 * @property string $TMA_DESCRIPCION
 *
 * @property Materiales[] $materiales
 * @property SactMatConsume[] $sactMatConsumes
 */
class TipoMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TMA_NOMBRE'], 'string', 'max' => 30],
            [['TMA_DESCRIPCION'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TMA_ID' => 'Tma  ID',
            'TMA_NOMBRE' => 'Tma  Nombre',
            'TMA_DESCRIPCION' => 'Tma  Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateriales()
    {
        return $this->hasMany(Materiales::className(), ['TMA_ID' => 'TMA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSactMatConsumes()
    {
        return $this->hasMany(SactMatConsume::className(), ['TMA_ID' => 'TMA_ID']);
    }
}
