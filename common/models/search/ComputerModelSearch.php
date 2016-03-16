<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ComputerModel;

/**
 * ComputerModelSearch represents the model behind the search form about `common\models\ComputerModel`.
 */
class ComputerModelSearch extends ComputerModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'],'string','length' => [1,128]],
            [['name', 'datetime_created', 'datetime_updated','brand_id'], 'safe'],
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
        $query = ComputerModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'computer_model.datetime_created' => $this->datetime_created,
            'computer_model.datetime_updated' => $this->datetime_updated,
        ]);

        $query->joinWith('brand');

        $query->andFilterWhere(['like', 'brand.name', $this->brand_id]);
        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
