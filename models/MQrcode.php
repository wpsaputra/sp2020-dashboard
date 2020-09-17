<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_qrcode".
 *
 * @property string $IDQR
 * @property string|null $IDSLS
 * @property string|null $IDKEC
 * @property string|null $IDDESA
 * @property string|null $KDPROV
 * @property string|null $KDKAB
 * @property string|null $KDKEC
 * @property string|null $KDDESA
 * @property string|null $IDSLSNON
 * @property string|null $NMPROV
 * @property string|null $NMKAB
 * @property string|null $NMKEC
 * @property string|null $NMDESA
 * @property string|null $NMSLSNON
 * @property int|null $Penduduk_Total
 * @property int|null $Keluarga_Total
 * @property int $flag_is_digunakan
 *
 * @property Batch[] $batches
 */
class MQrcode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_qrcode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDQR'], 'required'],
            [['Penduduk_Total', 'Keluarga_Total', 'flag_is_digunakan'], 'integer'],
            [['IDQR'], 'string', 'max' => 18],
            [['IDSLS'], 'string', 'max' => 14],
            [['IDKEC'], 'string', 'max' => 7],
            [['IDDESA'], 'string', 'max' => 10],
            [['KDPROV', 'KDKAB'], 'string', 'max' => 2],
            [['KDKEC', 'KDDESA'], 'string', 'max' => 3],
            [['IDSLSNON'], 'string', 'max' => 4],
            [['NMPROV'], 'string', 'max' => 17],
            [['NMKAB'], 'string', 'max' => 16],
            [['NMKEC'], 'string', 'max' => 19],
            [['NMDESA'], 'string', 'max' => 20],
            [['NMSLSNON'], 'string', 'max' => 50],
            [['IDQR'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IDQR' => 'Idqr',
            'IDSLS' => 'Idsls',
            'IDKEC' => 'Idkec',
            'IDDESA' => 'Iddesa',
            'KDPROV' => 'Kdprov',
            'KDKAB' => 'Kdkab',
            'KDKEC' => 'Kdkec',
            'KDDESA' => 'Kddesa',
            'IDSLSNON' => 'Idslsnon',
            'NMPROV' => 'Nmprov',
            'NMKAB' => 'Nmkab',
            'NMKEC' => 'Nmkec',
            'NMDESA' => 'Nmdesa',
            'NMSLSNON' => 'Nmslsnon',
            'Penduduk_Total' => 'Penduduk Total',
            'Keluarga_Total' => 'Keluarga Total',
            'flag_is_digunakan' => 'Flag Is Digunakan',
        ];
    }

    /**
     * Gets query for [[Batches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBatches()
    {
        return $this->hasMany(Batch::className(), ['IDQR' => 'IDQR']);
        
        
        // $query = $this->find();
        // // $query->joinWith(['batches']);
        // // $query->join("LEFT JOIN", "batch", 'm_qrcode.IDQR = batch.IDQR AND NOT EXISTS (
        // //     SELECT 1 FROM batch p1
        // //     WHERE p1.IDQR = m_qrcode.IDQR
        // //     AND p1.updated_date < batch.updated_date
        // //   )');

        // $query->join("LEFT JOIN", "batch p1", 'm_qrcode.IDQR = p1.IDQR');
        // $query->join("LEFT OUTER JOIN", "batch p2", "(m_qrcode.IDQR = p2.IDQR) AND 
        // (p1.updated_date < p2.updated_date OR (p1.updated_date = p2.updated_date AND p1.id < p2.id))");
        // $query->where("p2.id IS NULL");
        // return $query;

    }
}
