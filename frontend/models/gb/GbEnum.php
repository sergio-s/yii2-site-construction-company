<?php

namespace app\models\gb;

abstract class GbEnum
{
    const VISITOR_TYPE_GUEST = 'guest';
    const VISITOR_TYPE_REGISTERED = 'registered';
    
    const STATUS_ACTIVE = '1';//соотносится с полем status = 1 в таблице comments бд
    const STATUS_DISABLED = '0';//соотносится с полем status = 0 в таблице comments бд
    const STATUS_SPAM = '2';
    
    const NESTING_LEVEL = 7;//максимальный уровень вложенности коментариев
    
    public static function listVisitirType(){
        return[
            self::VISITOR_TYPE_GUEST => 'Гость',
            self::VISITOR_TYPE_REGISTERED => 'Зарегистрированный'
        ];
    }
}

