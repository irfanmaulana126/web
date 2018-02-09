<?php

namespace frontend\backend\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\master\models\User;

/**
 * UserSearch represents the model behind the search form of `frontend\backend\master\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'ACCESS_SITE', 'ONLINE', 'lft', 'rgt', 'lvl', 'icon_type', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'create_at', 'updated_at', 'ACCESS_ID', 'ACCESS_GROUP', 'ACCESS_LEVEL', 'UUID', 'ID_GOOGLE', 'ID_FB', 'ID_TWITTER', 'ID_LINKEDIN', 'ID_YAHOO', 'TEMPLATE', 'icon'], 'safe'],
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
        $query = User::find();

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
            'status' => $this->status,
            'create_at' => $this->create_at,
            'updated_at' => $this->updated_at,
            'ACCESS_SITE' => $this->ACCESS_SITE,
            'ONLINE' => $this->ONLINE,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'lvl' => $this->lvl,
            'icon_type' => $this->icon_type,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'ACCESS_ID', $this->ACCESS_ID])
            ->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'ACCESS_LEVEL', $this->ACCESS_LEVEL])
            ->andFilterWhere(['like', 'UUID', $this->UUID])
            ->andFilterWhere(['like', 'ID_GOOGLE', $this->ID_GOOGLE])
            ->andFilterWhere(['like', 'ID_FB', $this->ID_FB])
            ->andFilterWhere(['like', 'ID_TWITTER', $this->ID_TWITTER])
            ->andFilterWhere(['like', 'ID_LINKEDIN', $this->ID_LINKEDIN])
            ->andFilterWhere(['like', 'ID_YAHOO', $this->ID_YAHOO])
            ->andFilterWhere(['like', 'TEMPLATE', $this->TEMPLATE])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
