<?php
namespace common\components\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
/**
 * Class PurifyBehavior
 * @package yii2mod\behaviors
 */
class Long2ipBehavior extends Behavior
{
    /**
     * @var array attributes
     */
    public $attribute = 'ip';
    
    
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }
    
    //запись ip в базу данных в виде int
    public function beforeValidate()
    {
        $attribute = $this->attribute;
        $ip = Yii::$app->getRequest()->getUserIP();
        $this->owner->$attribute = sprintf('%u', ip2long($ip));
    }
    
    //извлечение ip из базы данных в виде int и конвертация в string
    public function afterFind()
    {
        $attribute = $this->attribute;
        
        $this->owner->$attribute = trim($this->owner->$attribute);
        
        if($this->owner->$attribute == "0" ){
            $this->owner->$attribute = "0.0.0.0";
            return;
        }
        $this->owner->$attribute = long2ip(-(4294967295 - ($this->owner->$attribute - 1)));
        
    }
    
    
}
