<?php

namespace app\models\gb;

use Yii;

/**
 * This is the model class for table "guestbook".
 *
 * @property string $id
 * @property integer $ip
 * @property string $visitor_type
 * @property string $user_id
 * @property integer $parent_id
 * @property integer $level
 * @property string $status
 * @property integer $visitor_city
 * @property string $subject
 * @property integer $message
 * @property string $createdDate
 *
 * @property User $user
 */
class Guestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guestbook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'visitor_type', 'status', 'visitor_city', 'subject', 'message', 'createdDate'], 'required'],
            [['ip', 'user_id', 'parent_id', 'level', 'visitor_city', 'message'], 'integer'],
            [['visitor_type', 'status'], 'string'],
            [['createdDate'], 'safe'],
            [['subject'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ip' => Yii::t('app', 'Ip'),
            'visitor_type' => Yii::t('app', 'Visitor Type'),
            'user_id' => Yii::t('app', 'User ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'level' => Yii::t('app', 'Level'),
            'status' => Yii::t('app', 'Status'),
            'visitor_city' => Yii::t('app', 'Visitor City'),
            'subject' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'createdDate' => Yii::t('app', 'Created Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return GuestbookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GuestbookQuery(get_called_class());
    }
}
