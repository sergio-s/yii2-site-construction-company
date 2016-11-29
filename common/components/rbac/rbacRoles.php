<?php
namespace common\components\rbac;
/*
 * rbacRoles
 */

class rbacRoles
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_GUEST = 'guest';

    const PERMISSION_ADMIN_CRUD = 'adminCrud';

    /**
     * Возвращает массив всех доступных ролей.
     * @return array
     * Используется для AuthManager в конфигурации приложения 'defaultRoles' => \common\models\User::roleArray(),
     */
    static public function roleArray()
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_USER,
            self::ROLE_GUEST
        ];
    }


}