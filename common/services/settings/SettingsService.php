<?php
namespace common\services\settings;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\InvalidParamException;
//REPO
use common\repositories\settings\ISettingsRepository;
use common\repositories\settings\SettingsRepositoryQuery;
use common\models\settings\SettingsEnum;

class SettingsService implements ISettingsService{
    
    public $settings = null;
    
    private $repo;
    private $idModule;//id модуля нстроек из бд
    
    const TYPE_ARRAY = 'array';
    const TYPE_JSON = 'json';


    public function __construct(ISettingsRepository $repo)
    {
        $this->repo = $repo;
    }
    
    public function hendlerOptionsFactory($id)
    {
        switch ($id) {
            case ($id === SettingsEnum::GB_SETTINGS_ID) :
                return new HendlerGB();
           
        }
    }
    
    public function findSettings($id = null)
    {
        if(!is_null($id)){
            if(array_key_exists($id, SettingsEnum::listID())){
                $this->idModule = $id;
                $this->settings = $this->repo->getSettingsById($id);
                
            }else{
                throw new InvalidParamException("Property 'id' which value {$id} not exists in db");
            }
            
        }else{
            $this->settings = $this->repo->getAllSettings();
        }
        return $this; 
    }
    
    /**
     * 
     * @param type $type (const TYPE_ARRAY = 'array';const TYPE_JSON = 'json';)
     * @return \common\services\settings\SettingsService
     * @throws InvalidParamException
     */
    public function getOptions($type)
    {
        if(!is_null($this->settings)){
            $options = ArrayHelper::getValue($this->settings, SettingsEnum::COL_OPTIONS);
            
            if($type === self::TYPE_ARRAY){
                $opt = self::asArray($options);
            }elseif($type === self::TYPE_JSON){
                $opt = self::asJson($options);
            }
            
            return $opt;
        }else{
            throw new InvalidParamException('Property "$this->settings" is must be determined');
        }
        
    }
    
    public static function asArray($data)
    {
        return static::is_JSON($data) ? Json::decode($data) : null;
    }
    
    public static function asJson($data)
    {
        return is_array($data) ? Json::encode($data) : null;
    }
    
    public  static function is_JSON($args) 
    {
        json_decode($args);
        return (json_last_error()===JSON_ERROR_NONE);
    }
    
    
    
}

