<?php

namespace hscstudio\mailbox\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "mesage".
 *
 * @property integer $id
 * @property integer $sender
 * @property integer $receiver
 * @property string $subject
 * @property string $content
 * @property integer $readed
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Mailbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailbox';
    }
	
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender', 'subject', 'content'], 'required'],
            [['sender', 'receiver', 'readed', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sender' => Yii::t('app', 'Sender'),
            'receiver' => Yii::t('app', 'Receiver'),
            'subject' => Yii::t('app', 'Subject'),
            'content' => Yii::t('app', 'Content'),
            'readed' => Yii::t('app', 'Readed'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
