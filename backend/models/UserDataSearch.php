<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserData;

/**
 * UserDataSearch represents the model behind the search form about `backend\models\UserData`.
 */
class UserDataSearch extends UserData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'source', 'count_meetings', 'count_meetings_last30', 'count_meeting_participant', 'count_meeting_participant_last30', 'count_places', 'count_friends', 'created_at', 'updated_at'], 'integer'],
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
        $query = UserData::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'source' => $this->source,
            'count_meetings' => $this->count_meetings,
            'count_meetings_last30' => $this->count_meetings_last30,
            'count_meeting_participant' => $this->count_meeting_participant,
            'count_meeting_participant_last30' => $this->count_meeting_participant_last30,
            'count_places' => $this->count_places,
            'count_friends' => $this->count_friends,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
