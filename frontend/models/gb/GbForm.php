<?php
namespace frontend\models\gb;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;


class GbForm extends Model
{
    public $visitor_name;
    public $visitor_city;
    public $subject;
    public $message;
    public $captcha;
    
    public $parent_id;//hidden (id parent message)
    
    const VISITOR_TYPE_GUEST = 'guest';
    const VISITOR_TYPE_REGISTERED = 'registered';
    
    const SCENARIO_GUEST = 'guest';
    const SCENARIO_REGISTERED = 'registered';
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios[self::SCENARIO_GUEST] = [
                'visitor_name', 
                'visitor_city', 
                'subject', 
                'message',
                'captcha',
                'parent_id'
            ];
        $scenarios[self::SCENARIO_REGISTERED] = [
                'visitor_city', 
                'subject', 
                'message',
                'parent_id'
            ];
        
        return $scenarios;
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['visitor_name', 'visitor_city', 'subject', 'message', 'captcha'], 'required'],
            [['visitor_name', 'visitor_city', 'subject'], 'string', 'max' => 60],
            [['message'], 'string', 'max' => 1000],
            ['captcha', 'captcha', 'captchaAction' => 'guest-book/captcha'],
            ['parent_id', 'safe'],
            
            //обработка
            [['visitor_name', 'visitor_city', 'subject', 'message'], 'trim'],
            ['parent_id', 'default', 'value' => 0],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'visitor_name' => 'Ваше имя',
            'visitor_city' => 'Ваш город',
            'subject' => 'Тема',
            'message' => 'Сообщение',
            'captcha' => 'Проверочный код'
        ];
    }
    
    public function attributePlaceholders()
    {
        $repeated = 'Пример: ';
        
        return [
            'visitor_name'  => $repeated.'Игорь',
            'visitor_city'  => $repeated.'Харьков',
            'subject'       => $repeated.'Ремонт ванной',
            'message'       => 'Текст Вашего сообщения...',
            'captcha' => 'Цифры с картинки'
        ];
    }
    
    public function getAttributePlaceholder($attribute)
    {
        $placeholders = $this->attributePlaceholders();
        return isset($placeholders[$attribute]) ? $placeholders[$attribute] : $this->generateAttributePlaceholder($attribute);
    }
    
    public function generateAttributePlaceholder($name)
    {
        return Inflector::camel2words($name, true);
    }
    
}
