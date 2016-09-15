<?php
namespace common\components\rbac;

use Yii;
use yii\rbac\Rule;
use common\models\User;

/**
 * User group rule class.
 */
class GroupRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'group';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;

            if ($item->name === rbacRoles::ROLE_ADMIN) {
                return $role == rbacRoles::ROLE_ADMIN;
            }
            elseif ($item->name === rbacRoles::ROLE_MODERATOR) {
                return $role == rbacRoles::ROLE_MODERATOR ||  $role == rbacRoles::ROLE_ADMIN;
            }
            elseif ($item->name === rbacRoles::ROLE_USER) {
                return $role == rbacRoles::ROLE_USER ||  $role == rbacRoles::ROLE_ADMIN || $role == rbacRoles::ROLE_MODERATOR;
            }
        }
        return false;
    }
}
?>
