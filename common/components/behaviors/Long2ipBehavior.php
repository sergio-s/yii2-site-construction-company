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
    
    /**
     * Declares event handlers for the [[owner]]'s events.
     *
     * Child classes may override this method to declare what PHP callbacks should
     * be attached to the events of the [[owner]] component.
     *
     * The callbacks will be attached to the [[owner]]'s events when the behavior is
     * attached to the owner; and they will be detached from the events when
     * the behavior is detached from the component.
     *
     **/
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }
    
    /**
     * Before validate event
     * !The ip param in db mast be integer type wich UNSIGNED attrbute
     */
    public function beforeValidate()
    {
        $attribute = $this->attribute;
        $ip = Yii::$app->getRequest()->getUserIP();
        $this->owner->$attribute = sprintf('%u', ip2long($ip));
    }
    
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
