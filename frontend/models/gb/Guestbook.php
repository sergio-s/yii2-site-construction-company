<?php

namespace app\models\gb;

use Yii;
use common\components\behaviors\PurifyBehavior;
use common\components\behaviors\Long2ipBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\tags\Tags;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\tags\TagsGuestbook;
/**
 * This is the model class for table "guestbook".
 *
 * @property string $id
 * @property integer $ip
 * @property string $visitor_type
 * @property string $author_id
 * @property string $updater_id
 * @property string $visitor_name
 * @property integer $parent_id
 * @property integer $level
 * @property string $status
 * @property integer $visitor_city
 * @property integer $message
 * @property string $createdDate
 *
 * @property User $user
 */
class Guestbook extends \yii\db\ActiveRecord
{
    protected $childMessages;//дочерние комментарии
    
    private $userIdentityClass = null;
    private $tags_id = [];
    
    public function init()
    {
        parent::init();
        if ($this->userIdentityClass === null) {
            $this->userIdentityClass = Yii::$app->getUser()->identityClass;// по умолчанию common\models\User
        }
    }
    
    
    /**
     * @return array
     */
    public static function getStatusList(){
        return[
            GbEnum::STATUS_ACTIVE => 'Активен',
            GbEnum::STATUS_DISABLED => 'Отключен',//отключен
            GbEnum::STATUS_SPAM => 'Спам',
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
//            [['ip', 'author_id', 'updater_id','createdDate'], 'safe'],
//            [['subject'], 'string', 'max' => 255],
//            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['author_id', 'default', 'value' => null],
            ['parent_id', 'default', 'value' => 0],
            ['super_parent_id', 'default', 'value' => 0],
//            ['parent_id', 'validateParentID'],
            ['status', 'default', 'value' => (string)GbEnum::STATUS_ACTIVE],
            ['level', 'default', 'value' => 0],
            [['ip', 'visitor_type', 'author_id', 'updater_id', 'visitor_name', 'parent_id','super_parent_id', 'level','status','visitor_city','message','createdDate','updatedDate', 'tags'], 'safe'],
        ];
    }

    
    /**
     * Проверка, существует ли родительское сообщение
     * @param $attribute
     */
    public function validateParentID($attribute)
    {
        if ($this->{$attribute} !== 0)
        {
//            $comment = self::find()->where(['id' => $this->{$attribute}, 'entity' => $this->entity, 'entityId' => $this->entityId])->active()->exists();//для комментариев,т.к указывается сущность entity(статьи, галерея и т.п. виды материалов)
            $comment = self::find()->where(['id' => $this->{$attribute}])->active()->exists();
            if ($comment === FALSE)
            {
                $this->addError('content', Yii::t('app', 'Comment on which you are trying to answer can not be found.'));
            }
        }
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
            'author_id' => Yii::t('app', 'User ID'),
            'updater_id' => Yii::t('app', 'Updater ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'super_parent_id' => Yii::t('app', 'super_parent_id'),
            'level' => Yii::t('app', 'Level'),
            'status' => Yii::t('app', 'Status'),
            'visitor_city' => Yii::t('app', 'Visitor City'),
            'message' => Yii::t('app', 'Message'),
            'createdDate' => Yii::t('app', 'Created Date'),
        ];
    }

    public function behaviors()
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::className(),//устанавливаем id юзера
                'createdByAttribute' => 'author_id',
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
    
        public function beforeValidate() {
        //гость
        if(Yii::$app->user->isGuest){
            $this->visitor_type = GbEnum::VISITOR_TYPE_GUEST;
        
        //зарегестрированный    
        }else{
            $this->visitor_type = GbEnum::VISITOR_TYPE_REGISTERED;
        }
        return parent::beforeValidate();
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
//                                      РАБОТА С ТЕГАМИ
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////                                      
    //вставляем в таблицу тегов-сообщений id сообщения и  id тега из формы
    public function afterSave($insert, $changedAttributes)
    {
        //TagPost::deleteAll(['post_id' => $this->id]);
        $values = [];
        $message_id = $this->id;
        foreach ($this->tags_id as $tag_id) {
            $values[] = [$tag_id, $message_id];
        }
        self::getDb()->createCommand()
            ->batchInsert(TagsGuestbook::tableName(), ['tag_id', 'message_id'], $values)->execute();

        parent::afterSave($insert, $changedAttributes);
    }
    
    public function setTagsId($value)
    {
        $this->tags_id = $value;
    }

    
    //теги для сооьщения
    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])
            ->viaTable('tags_guestbook', ['message_id' => 'id']);
        //return $this->hasMany(Tags::className(), ['message_id' => 'id']);
    }
    public function hasTags()
    {
        return !empty($this->tags) ? true : false;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
//                                      ДАТА И ВРЕМЯ
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Get created date
     *
     * @param string $format date format
     * @return string
     */
    public function getCreatedDate($format = 'Y-m-d')
    {
        return date($format, ($this->isNewRecord) ? time() : strtotime($this->createdDate));
    }
    /**
     * Get created date
     *
     * @param string $format date format
     * @return string
     */
    public function getUpdatedDate($format = 'Y-m-d')
    {
        return date($format, ($this->isNewRecord) ? time() : strtotime($this->updatedDate));
    }
    
    
    /**
     * Get created time
     *
     * @param string $format time format
     * @return string
     */
    public function getCreatedTime($format = 'H:i')
    {
        return date($format, ($this->isNewRecord) ? time() : strtotime($this->createdDate));
    }
    /**
     * Get created time
     *
     * @param string $format time format
     * @return string
     */
    public function getUpdatedTime($format = 'H:i')
    {
        return date($format, ($this->isNewRecord) ? time() : strtotime($this->updatedDate));
    }
    

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
//                                      АВТОРЫ
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getIsAuthorRegistered()
    {
        return $this->visitor_type === GbEnum::VISITOR_TYPE_REGISTERED;
    }
    
    public function getIsAuthorGuest()
    {
        return $this->visitor_type === GbEnum::VISITOR_TYPE_GUEST;
    }
    
    public function printVisitorType($visitor_type)
    {
        return GbEnum::listVisitirType()[$visitor_type];
    }
    
    /**
     * Кто добавил запись
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        if($this->author_id){
//            return $this->hasOne(User::className(), ['id' => 'author_id']);
            return $this->hasOne($this->userIdentityClass, ['id' => 'author_id']);
        }
        return FALSE;
    }

    
    //admin style ['class' => 'img-gb-admin img-respons']
    public function getAvatar($options = [])
    {
        $defaultOptions = ['alt' => '', 'class' => 'gb-avatarImg img-respons'];
        $imgOptions = ArrayHelper::merge($defaultOptions, $options);
        
        $defaultImg = Html::img('@avatar-img-web/default.png', $imgOptions);
        
        if($this->isAuthorGuest){
            $res = $defaultImg;
        }
        elseif($this->isAuthorRegistered){
            if(null != $this->author->avatar_id){
                $res = Html::img('@avatar-img-web/'.$this->author->avatar->alias, $imgOptions);
            }else{
                $res = $defaultImg;
            }
                
        }else{
            $res =  'Нет аватара';
        }
        
        return $res;
    }
    
    /**
     * Кто последний обновил запись
     * @return \yii\db\ActiveQuery
     */
    
    public function getLastUpdateAuthor()
    {
        if($this->author_id){
            return $this->hasOne(User::className(), ['id' => 'updater_id']);
        }
        return FALSE;
        
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                              СТАТУСЫ СООБЩЕНИЯ
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * @return boolean Если комментарий активен
     */
    public function getIsActive()
    {
        return $this->status === GbEnum::STATUS_ACTIVE;
    }
    
    
    /**
     * @return boolean Если комментарий активен
     */
    public function getIsSpam()
    {
        return $this->status === GbEnum::STATUS_SPAM;
    }
     /**
     * @return boolean Если комментарий отключен
     */
    public function getIsDisabled()
    {
        return $this->status === GbEnum::STATUS_DISABLED;
    }
    
    //Редактировалось ли сообщение
    public function isEdited()
    {
        return $this->createdDate !== $this->updatedDate;
    }

    
    /**
     * Количество ответов у данного комментария
     *
     * @return int nubmer of replies
     */
    public function isReplied()
    {
        return self::find()->where(['parent_id' => $this->id])->active()->count();
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Количество всех активных коментариев
     * @param type $model
     * @param type $model_id
     * @return type
     */
    public static function activeCount()
    {
        return self::find()->active()->count();
    }
    
     /**
     * return id of all chief messages
     */
    public static function getChiefId()
    {
        $query = self::find()
                ->select(['id'])
                ->chiefAncestor();
//                ->active();
        return $query;
//        if ($maxLevel > 0) {
//            $query->andWhere(['<=', 'level', $maxLevel]);
//        }

    }
    
    public function hasChildren()
    {
        return !empty($this->childMessages) ? true : false;
    }
    
    /**
     * @return null|array|ActiveRecord[] Comment children
     */
    public function getChildMessages()
    {
        return $this->childMessages;
    }

    /**
     * $_children setter.
     *
     * @param array|ActiveRecord[] $value Comment children
     */
    public function setChildMessages($value)
    {
        $this->childMessages = $value;
    }
    
    
    //рекурсивное построение дерева сообщений
    public static function buildTree(&$data, $rootID = 0)
    {
        $tree = [];
        foreach ($data as $key => $node) {
            if ($node->parent_id == $rootID) {
                unset($data[$key]);
                $node->childMessages = self::buildTree($data, $node->id);
                
                if(is_array($node->childMessages) && count($node->childMessages) > 0){
                    $node->childMessages = array_reverse($node->childMessages);//для того, чтобы дочерние сообщения размещались от ст
                }
                
                $tree[] = $node;
            }
        }
        return $tree;
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
