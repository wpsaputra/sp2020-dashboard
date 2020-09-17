<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MQrcode;

/**
 * MQrcodeSearch represents the model behind the search form of `app\models\MQrcode`.
 */
class MQrcodeSearch extends MQrcode
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDQR', 'IDSLS', 'IDKEC', 'IDDESA', 'KDPROV', 'KDKAB', 'KDKEC', 'KDDESA', 'IDSLSNON', 'NMPROV', 'NMKAB', 'NMKEC', 'NMDESA', 'NMSLSNON'], 'safe'],
            [['Penduduk_Total', 'Keluarga_Total', 'flag_is_digunakan'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MQrcode::find();
        // $query->joinWith(['batches']);
        // $query->join("LEFT JOIN", "batch", 'm_qrcode.IDQR = batch.IDQR AND NOT EXISTS (
        //     SELECT 1 FROM batch p1
        //     WHERE p1.IDQR = m_qrcode.IDQR
        //     AND p1.updated_date < batch.updated_date
        //   )');

        // $query->join("LEFT JOIN", "batch p1", 'm_qrcode.IDQR = p1.IDQR');
        // $query->join("LEFT OUTER JOIN", "batch p2", "(m_qrcode.IDQR = p2.IDQR) AND 
        // (p1.updated_date < p2.updated_date OR (p1.updated_date = p2.updated_date AND p1.id < p2.id))");
        // $query->where("p2.id IS NULL");


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Penduduk_Total' => $this->Penduduk_Total,
            'Keluarga_Total' => $this->Keluarga_Total,
            'flag_is_digunakan' => $this->flag_is_digunakan,
        ]);

        $query->andFilterWhere(['like', 'm_qrcode.IDQR', $this->IDQR])
            ->andFilterWhere(['like', 'IDSLS', $this->IDSLS])
            ->andFilterWhere(['like', 'IDKEC', $this->IDKEC])
            ->andFilterWhere(['like', 'IDDESA', $this->IDDESA])
            ->andFilterWhere(['like', 'KDPROV', $this->KDPROV])
            ->andFilterWhere(['like', 'KDKAB', $this->KDKAB])
            ->andFilterWhere(['like', 'KDKEC', $this->KDKEC])
            ->andFilterWhere(['like', 'KDDESA', $this->KDDESA])
            ->andFilterWhere(['like', 'IDSLSNON', $this->IDSLSNON])
            ->andFilterWhere(['like', 'NMPROV', $this->NMPROV])
            ->andFilterWhere(['like', 'NMKAB', $this->NMKAB])
            ->andFilterWhere(['like', 'NMKEC', $this->NMKEC])
            ->andFilterWhere(['like', 'NMDESA', $this->NMDESA])
            ->andFilterWhere(['like', 'NMSLSNON', $this->NMSLSNON]);

        return $dataProvider;
    }
}
