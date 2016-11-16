<?php

namespace app\models\tags;

use Yii;

/**
 * This is the model class for table "tags_guestbook".
 *
 * @property string $id
 * @property string $tag_id
 * @property string $message_id
 *
 * @property Guestbook $message
 * @property Tags $tag
 */
class TagsGuestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags_guestbook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'message_id'], 'required'],
            [['tag_id', 'message_id'], 'integer'],
            [['tag_id', 'message_id'], 'unique', 'targetAttribute' => ['tag_id', 'message_id'], 'message' => 'The combination of Tag ID and Message ID has already been taken.'],
            [['message_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guestbook::className(), 'targetAttribute' => ['message_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
            'message_id' => Yii::t('app', 'Message ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Guestbook::className(), ['id' => 'message_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }
}
