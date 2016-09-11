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
    
    const SCENARIO_GUEST = 'guest';
    const SCENARIO_REGISTERED = 'registered';
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios[self::SCENARIO_GUEST] = [
                'visitor_name', 
                'visitor_city', 
                'subject', 
                'message'
            ];
        $scenarios[self::SCENARIO_REGISTERED] = [
                'visitor_city', 
                'subject', 
                'message'
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
            [['visitor_name', 'visitor_city', 'subject', 'message'], 'required'],
            [['visitor_name', 'visitor_city', 'subject'], 'string', 'max' => 60],
            [['message'], 'string', 'max' => 1000],
//            ['visitor_city', 'safe'],
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
