<?php
namespace frontend\models\gb;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;
use app\models\tags\Tags;

class GbForm extends Model
{
    public $visitor_name;
    public $visitor_city;
    public $subject;
    public $message;
    public $captcha;
    
    public $parent_id;//hidden (id parent message)
    
    /**
     * Список тэгов, выбранных в форме создания сообщения.
     * @var array
     */
    public $tags = [];
    
    const SCENARIO_GUEST = 'guest';
    const SCENARIO_REGISTERED = 'registered';
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios[self::SCENARIO_GUEST] = [
                'visitor_name', 
                'visitor_city', 
                'message',
                'captcha',
                'parent_id',
                'tags'
            ];
        $scenarios[self::SCENARIO_REGISTERED] = [
                'visitor_city', 
                'message',
                'parent_id',
                'tags'
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
            [['visitor_name', 'visitor_city', 'tags', 'message', 'captcha'], 'required'],
//            ['tags', 'custom_function_validation', 'values' => ['One', 'Two']],
//            ['tags', 'checkIsArray'],
            [['visitor_name', 'visitor_city'], 'string', 'max' => 60],
            [['message'], 'string', 'max' => 1000],
            ['captcha', 'captcha', 'captchaAction' => 'guest-book/captcha'],
            ['parent_id', 'safe'],
            
            //обработка
            [['visitor_name', 'visitor_city', 'message'], 'trim'],
            ['parent_id', 'default', 'value' => 0],
            
        ];
    }

    

    public function init()
    {
        parent::init();
        if (Yii::$app->getUser()->getIsGuest())
        {
            $this->scenario = self::SCENARIO_GUEST;
        }
        else
        {
            $this->scenario = self::SCENARIO_REGISTERED;
        }
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
            'captcha' => 'Проверочный код',
            'tags' => 'Теги'
        ];
    }
    
    public function attributePlaceholders()
    {
        $repeated = 'Пример: ';
        
        return [
            'visitor_name'  => $repeated.'Игорь',
            'visitor_city'  => $repeated.'Харьков',
            'message'       => 'Текст Вашего сообщения...',
            'captcha' => 'Цифры с картинки'
        ];
    }
    
    public function getDropdownListTags(){
        return ArrayHelper::map(Tags::find()->all(), 'id', 'tag');
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
