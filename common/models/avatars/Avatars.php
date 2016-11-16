<?php

namespace common\models\avatars;

use Yii;

/**
 * This is the model class for table "avatars".
 *
 * @property string $id
 * @property string $alias
 *
 * @property User[] $users
 */
class Avatars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'avatars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'required'],
            [['alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['avatar_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AvatarsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AvatarsQuery(get_called_class());
    }
}
