<?php

namespace hscstudio\mailbox\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hscstudio\mailbox\models\Mailbox;

/**
 * MailboxSearch represents the model behind the search form about `hscstudio\mailbox\models\Mailbox`.
 */
class MailboxSearch extends Mailbox
{
    public function rules()
    {
        return [
            [['id', 'sender', 'receiver', 'readed', 'status', 'created_at', 'updated_at'], 'integer'],
            [['subject', 'content'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Mailbox::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'readed' => $this->readed,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
