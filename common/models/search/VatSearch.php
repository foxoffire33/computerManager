<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vat;

/**
 * VatSearch represents the model behind the search form about `common\models\Vat`.
 */
class VatSearch extends Vat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'procentage'], 'integer'],
            [['name', 'datetime_created', 'datetime_updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Vat::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'procentage' => $this->procentage,
            'datetime_created' => $this->datetime_created,
            'datetime_updated' => $this->datetime_updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
