<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property integer $PRO_ID
 * @property integer $COM_ID
 * @property string $EMP_RUT
 * @property string $PRO_NOMBRE
 * @property string $PRO_OBSERVACIONES
 * @property string $PRO_DESCRIPCION
 * @property integer $PRO_COSTO_TOTAL
 * @property string $PRO_FECHA_INICIO
 * @property string $PRO_FECHA_FINAL
 * @property string $PRO_INFORME
 * @property string $PRO_ESTADO
 *
 * @property ContratoObrero[] $contratoObreros
 * @property GastosGenerales[] $gastosGenerales
 * @property OrdenTrabajo[] $ordenTrabajos
 * @property EmpresaCliente $eMPRUT
 * @property Comuna $cOM
 * @property UsuariosControla[] $usuariosControlas
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COM_ID', 'EMP_RUT'], 'required'],
            [['COM_ID', 'PRO_COSTO_TOTAL'], 'integer'],
            [['PRO_OBSERVACIONES'], 'string'],
            [['PRO_FECHA_INICIO', 'PRO_FECHA_FINAL'], 'safe'],
            [['EMP_RUT'], 'string', 'max' => 15],
               [['PRO_NOMBRE', 'PRO_DESCRIPCION', 'PRO_DIRECCION', 'PRO_INFORME'], 'string', 'max' => 100],
               [['PRO_ESTADO'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PRO_ID' => 'ID',
            'COM_ID' => 'Comuna',
            'EMP_RUT' => 'Cliente',
            'PRO_NOMBRE' => 'Nombre',
            'PRO_OBSERVACIONES' => 'Observaciones',
            'PRO_DESCRIPCION' => 'Descripción',
            'PRO_COSTO_TOTAL' => 'Costo Total',
            'PRO_FECHA_INICIO' => 'Fecha Inicio',
            'PRO_FECHA_FINAL' => 'Fecha Final',
            'PRO_DIRECCION' => 'Dirección',
            'PRO_INFORME' => 'Informe',
            'PRO_ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratoObreros()
    {
        return $this->hasMany(ContratoObrero::className(), ['PRO_ID' => 'PRO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGastosGenerales()
    {
        return $this->hasMany(GastosGenerales::className(), ['PRO_ID' => 'PRO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenTrabajos()
    {
        return $this->hasMany(OrdenTrabajo::className(), ['PRO_ID' => 'PRO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEMPRUT()
    {
        return $this->hasOne(EmpresaCliente::className(), ['EMP_RUT' => 'EMP_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOM()
    {
        return $this->hasOne(Comuna::className(), ['COM_ID' => 'COM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosControlas()
    {
        return $this->hasMany(UsuariosControla::className(), ['PRO_ID' => 'PRO_ID']);
    }
}
