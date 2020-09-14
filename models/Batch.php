<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batch".
 *
 * @property int $id
 * @property string $IDQR
 * @property int $107a
 * @property int $107b
 * @property int $107c
 * @property int $107d
 * @property int $108a
 * @property int $108b
 * @property int $109a
 * @property int $109b
 * @property int $id_petugas
 * @property string $created_date
 * @property string $updated_date
 *
 * @property MQrcode $iDQR
 * @property Registrasi $petugas
 */
class Batch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDQR', '107a', '107b', '107c', '107d', '108a', '108b', '109a', '109b', 'id_petugas'], 'required'],
            [['107a', '107b', '107c', '107d', '108a', '108b', '109a', '109b', 'id_petugas'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['IDQR'], 'string', 'max' => 18],
            [['IDQR'], 'exist', 'skipOnError' => true, 'targetClass' => MQrcode::className(), 'targetAttribute' => ['IDQR' => 'IDQR']],
            [['id_petugas'], 'exist', 'skipOnError' => true, 'targetClass' => Registrasi::className(), 'targetAttribute' => ['id_petugas' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'IDQR' => 'Idqr',
            '107a' => '107a',
            '107b' => '107b',
            '107c' => '107c',
            '107d' => '107d',
            '108a' => '108a',
            '108b' => '108b',
            '109a' => '109a',
            '109b' => '109b',
            'id_petugas' => 'Id Petugas',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * Gets query for [[IDQR]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIDQR()
    {
        return $this->hasOne(MQrcode::className(), ['IDQR' => 'IDQR']);
    }

    /**
     * Gets query for [[Petugas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPetugas()
    {
        return $this->hasOne(Registrasi::className(), ['id' => 'id_petugas']);
    }
}
