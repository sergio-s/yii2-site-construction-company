<?php
namespace common\components\rbac;
/*
 * rbacRoles
 */

class rbacPermissions
{
    const PERMISSION_ADMIN_PANEL = 'permissionAdminPanel';

    /**
     * Возвращает массив всех доступных ролей.
     * @return array
     * Используется для AuthManager в конфигурации приложения 'defaultRoles' => \common\models\User::roleArray(),
     */
    static public function roleArray()
    {
        return [
            self::PERMISSION_ADMIN_PANEL,
        ];
    }


}