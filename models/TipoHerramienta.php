<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_herramienta".
 *
 * @property integer $TH_ID
 * @property string $TH_NOMBRE
 * @property string $TH_DESCRIPCION
 *
 * @property Herramientas[] $herramientas
 * @property SactHeOcupan[] $sactHeOcupans
 */
class TipoHerramienta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_herramienta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TH_NOMBRE'], 'string', 'max' => 30],
            [['TH_DESCRIPCION'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TH_ID' => 'Th  ID',
            'TH_NOMBRE' => 'Th  Nombre',
            'TH_DESCRIPCION' => 'Th  Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHerramientas()
    {
        return $this->hasMany(Herramientas::className(), ['TH_ID' => 'TH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSactHeOcupans()
    {
        return $this->hasMany(SactHeOcupan::className(), ['TH_ID' => 'TH_ID']);
    }
}
