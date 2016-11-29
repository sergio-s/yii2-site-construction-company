<?php
namespace common\models\settings;

abstract class SettingsEnum
{
    //common constants
    const COL_TITLE  = 'title';
    const COL_DESCR  = 'description';
    const COL_OPTIONS = 'options';//массив настроек

    //guest book
    const GB_SETTINGS_ID = 1;//id in table settings
    const MODER_NEW_MES = 'groups_moder_new_messages';
    
    public static function listID(){
        return[
            self::GB_SETTINGS_ID => 'Настройки гостевой книги',
        ];
    }
    
    
}

