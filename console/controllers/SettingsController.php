<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Json;
use common\components\rbac\rbacRoles;

class SettingsController extends Controller
{
    const TABLE_NAME = 'settings';
    
    const GB_SETTINGS = 1;//id in table settings
    const MODER_NEW_MES = 'moderation_new_messages';


    public function actionGb()
    {
        $settings = [
            self::MODER_NEW_MES => [
                'fromGroups' => [rbacRoles::ROLE_GUEST]
                ],
        ];
        (new \yii\db\Query())
                ->createCommand()
                ->update(self::TABLE_NAME, ['object' => Json::encode($settings)])
                ->execute();
        
        echo 'is updated';
        return 0;
    }
    
    
}

