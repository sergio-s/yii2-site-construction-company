<?php

namespace app\models\gb;

use Yii;
use common\components\behaviors\PurifyBehavior;
use common\components\behaviors\Long2ipBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "guestbook".
 *
 * @property string $id
 * @property integer $ip
 * @property string $visitor_type
 * @property string $autor_id
 * @property string $updater_id
 * @property string $visitor_name
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
    const STATUS_ACTIVE = 1;//соотносится с полем status = 1 в таблице comments бд
    const STATUS_DISABLED = 0;//соотносится с полем status = 0 в таблице comments бд
    
        /**
     * @return array
     */
    public static function getStatusList(){
        return[
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_DISABLED => 'Отключен'//отключен
        ];
    }
    
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
//            [['visitor_type', 'status', 'visitor_city', 'subject', 'message', 'createdDate'], 'required'],
//            [['ip', 'parent_id', 'level', 'visitor_city', 'message'], 'integer'],
//            [['visitor_type', 'status'], 'string'],
//            [['ip', 'autor_id', 'updater_id','createdDate'], 'safe'],
//            [['subject'], 'string', 'max' => 255],
//            [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['status', 'default', 'value' => (string)self::STATUS_ACTIVE],
            ['level', 'default', 'value' => 0],
            [['ip', 'visitor_type', 'autor_id', 'updater_id', 'visitor_name', 'parent_id','level','status','visitor_city','subject','message','createdDate','updatedDate'], 'safe'],
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
            'autor_id' => Yii::t('app', 'User ID'),
            'updater_id' => Yii::t('app', 'Updater ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'level' => Yii::t('app', 'Level'),
            'status' => Yii::t('app', 'Status'),
            'visitor_city' => Yii::t('app', 'Visitor City'),
            'subject' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'createdDate' => Yii::t('app', 'Created Date'),
        ];
    }

    public function behaviors()
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::className(),//устанавливаем id юзера
                'createdByAttribute' => 'autor_id',
                'updatedByAttribute' => 'updater_id',
            ],
            'timestamp' => [//Использование поведения TimestampBehavior ActiveRecord
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['createdDate'],
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updatedDate'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'purify' => [
                'class' => PurifyBehavior::className(),//защита введенного контента от вред. кода
                'attributes' => ['visitor_name', 'visitor_city', 'message']
            ],
            'long2ip' => [
                'class' => Long2ipBehavior::className(),//!The ip param in db mast be integer type wich UNSIGNED attrbute
                'attribute' => 'ip',
            ],
        ];
    }
    
    //Оприделяем уровень вложенности сообщения
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->parent_id > 0) {
                $parentNodeLevel = (int)self::find()->select('level')->where(['id' => $this->parent_id])->scalar();
                $this->level = $parentNodeLevel + 1;
            }
            return true;
        } else {
            return false;
        }
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
