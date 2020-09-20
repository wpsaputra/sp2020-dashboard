<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registrasi".
 *
 * @property int $id
 * @property string $no_hp
 * @property string $nama
 * @property string $kode_provinsi
 * @property string $kode_kab
 * @property string $kode_petugas
 * @property int $flag_a
 * @property int $flag_b
 *
 * @property Batch[] $batches
 * @property MKab $kodeKab
 * @property MProv $kodeProvinsi
 */
class Registrasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registrasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_hp', 'nama', 'kode_provinsi', 'kode_kab', 'kode_petugas'], 'required'],
            [['flag_a', 'flag_b'], 'integer'],
            [['no_hp'], 'string', 'max' => 14],
            [['nama'], 'string', 'max' => 255],
            [['kode_provinsi'], 'string', 'max' => 2],
            [['kode_kab'], 'string', 'max' => 4],
            [['kode_petugas'], 'string', 'max' => 20],
            [['kode_kab'], 'exist', 'skipOnError' => true, 'targetClass' => MKab::className(), 'targetAttribute' => ['kode_kab' => 'id']],
            [['kode_provinsi'], 'exist', 'skipOnError' => true, 'targetClass' => MProv::className(), 'targetAttribute' => ['kode_provinsi' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_hp' => 'No Hp',
            'nama' => 'Nama',
            'kode_provinsi' => 'Kode Provinsi',
            'kode_kab' => 'Kode Kab',
            'kode_petugas' => 'Kode Petugas',
            'flag_a' => 'Flag A',
            'flag_b' => 'Flag B',
        ];
    }

    /**
     * Gets query for [[Batches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBatches()
    {
        return $this->hasMany(Batch::className(), ['id_petugas' => 'id']);
    }

    /**
     * Gets query for [[KodeKab]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKodeKab()
    {
        return $this->hasOne(MKab::className(), ['id' => 'kode_kab']);
    }

    /**
     * Gets query for [[KodeProvinsi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKodeProvinsi()
    {
        return $this->hasOne(MProv::className(), ['id' => 'kode_provinsi']);
    }
}
