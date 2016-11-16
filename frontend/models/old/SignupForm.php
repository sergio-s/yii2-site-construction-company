<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;


/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    private $_defaultRole;
    
    //$defaultRole передаем при инициализации класса при обработке формы регистрации
    public function __construct($defaultRole, $config = [])
    {
        $this->_defaultRole = $defaultRole;
        parent::__construct($config);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->role = $this->_defaultRole;//назначаем роль при регистрации
        
        if($user->save()){
            // добавляем привязку id юзера к id назначенной роли
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole($this->_defaultRole);
            $auth->assign($authorRole, $user->getId());
            
            return $user;
        }
        return  null;
    }
}
