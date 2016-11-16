<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\components\rbac\GroupRule;
use yii\rbac\DbManager;
use common\models\User;

class RbacController extends Controller
{
    public function actionInit($id = null)
    {
//        $auth = new DbManager;
//        $auth->init();
        $auth = Yii::$app->authManager;
        
        
        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...
        
        // Rules
        //$groupRule = new GroupRule();
        //$auth->add($groupRule);

        ////////////////////////////////////////////////////////////////////////
        //                          ROLES
        ////////////////////////////////////////////////////////////////////////
        
        // Role user
        $user = $auth->createRole('user');
        $user->description = 'Роль User';
        $user->ruleName = $groupRule->name;
        $auth->add($user);

        // Role moderator
        $moderator = $auth->createRole('moderator');
        $moderator ->description = 'Роль Moderator';
        $moderator ->ruleName = $groupRule->name;
        $auth->add($moderator);
        $auth->addChild($moderator, $user);

        // Role admin
        $admin = $auth->createRole('admin');
        $admin->description = 'Роль Admin';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $adminCrud);//обавл. разрешение "adminCrud"


        ////////////////////////////////////////////////////////////////////////
        //                        PERMISSIONS
        ////////////////////////////////////////////////////////////////////////
        
        // добавляем разрешение "adminCrud"
        $adminCrud = $auth->createPermission('adminCrud');
        $adminCrud->description = 'Административные фунции CRUD';
        $auth->add($adminCrud);

        
        
        
    }

}
