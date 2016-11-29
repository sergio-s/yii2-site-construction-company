<?php
namespace common\services\settings;

interface ISettingsService{
    
    public function findSettings($id = null);
    
    public function getOptions($type);
    
    public static function asArray($data);
    
    public static function asJson($data);
    
    public  static function is_JSON($args); 

    
}

