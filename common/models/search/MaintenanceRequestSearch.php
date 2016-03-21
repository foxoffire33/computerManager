<?php

namespace common\models\search;

use common\models\MaintenanceRequest;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MaintenanceRequestSearch represents the model behind the search form about `common\models\MaintenanceRequest`.
 */
class MaintenanceRequestSearch extends MaintenanceRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['description', 'date_done', 'date_apointment', 'computer_id'], 'safe'],
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
        $query = MaintenanceRequest::find();

        $query->joinWith('computer');

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
            'status' => $this->status,
            'date_done' => $this->date_done,
            'date_apointment' => $this->date_apointment,
        ]);

        $query->andFilterWhere(['like', 'computer_summary.name', $this->computer_id]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
