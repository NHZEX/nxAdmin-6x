<?php /** @noinspection ALL - For disable PhpStorm check */
//export date: 2019-11-25T14:43:52+08:00
return [
    [
        'id' => 1,
        'genre' => 1,
        'sort' => 0,
        'name' => 'login',
        'pid' => '__ROOT__',
        'control' => '{"allow": ["node@admin.main/index", "node@admin.main/sysinfo", "node@admin.main/clearcache"]}',
        'desc' => '用户登录后授予的权限',
    ],
    [
        'id' => 2,
        'genre' => 1,
        'sort' => 0,
        'name' => 'menu',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '菜单',
    ],
    [
        'id' => 3,
        'genre' => 1,
        'sort' => 0,
        'name' => 'menu.del',
        'pid' => 'menu',
        'control' => '{"allow": ["node@admin.menu/delete"]}',
        'desc' => '删除菜单',
    ],
    [
        'id' => 4,
        'genre' => 1,
        'sort' => 0,
        'name' => 'menu.edit',
        'pid' => 'menu',
        'control' => '{"allow": ["node@admin.menu/save"]}',
        'desc' => '编辑菜单',
    ],
    [
        'id' => 5,
        'genre' => 1,
        'sort' => 0,
        'name' => 'menu.export',
        'pid' => 'menu',
        'control' => '{"allow": ["node@admin.menu/export"]}',
        'desc' => '导出菜单',
    ],
    [
        'id' => 6,
        'genre' => 1,
        'sort' => 0,
        'name' => 'menu.info',
        'pid' => 'menu',
        'control' => '{"allow": ["node@admin.menu/index", "node@admin.menu/table", "node@admin.menu/edit"]}',
        'desc' => '查看菜单',
    ],
    [
        'id' => 7,
        'genre' => 1,
        'sort' => 0,
        'name' => 'permission',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '权限',
    ],
    [
        'id' => 8,
        'genre' => 1,
        'sort' => 0,
        'name' => 'permission.del',
        'pid' => 'permission',
        'control' => '{"allow": ["node@admin.permission/del"]}',
        'desc' => '删除权限',
    ],
    [
        'id' => 9,
        'genre' => 1,
        'sort' => 0,
        'name' => 'permission.edit',
        'pid' => 'permission',
        'control' => '{"allow": ["node@admin.permission/save"]}',
        'desc' => '编辑权限',
    ],
    [
        'id' => 10,
        'genre' => 1,
        'sort' => 0,
        'name' => 'permission.info',
        'pid' => 'permission',
        'control' => '{"allow": ["node@admin.permission/index", "node@admin.permission/edit", "node@admin.permission/permissiontree", "node@admin.permission/get"]}',
        'desc' => '查看权限',
    ],
    [
        'id' => 11,
        'genre' => 1,
        'sort' => 0,
        'name' => 'permission.lasting',
        'pid' => 'permission',
        'control' => '{"allow": ["node@admin.permission/lasting"]}',
        'desc' => '导出权限',
    ],
    [
        'id' => 12,
        'genre' => 1,
        'sort' => 0,
        'name' => 'permission.scan',
        'pid' => 'permission',
        'control' => '{"allow": ["node@admin.permission/scan"]}',
        'desc' => '重建权限',
    ],
    [
        'id' => 13,
        'genre' => 1,
        'sort' => 0,
        'name' => 'role',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '角色',
    ],
    [
        'id' => 14,
        'genre' => 1,
        'sort' => 0,
        'name' => 'role.del',
        'pid' => 'role',
        'control' => '{"allow": ["node@admin.role/delete"]}',
        'desc' => '删除角色',
    ],
    [
        'id' => 15,
        'genre' => 1,
        'sort' => 0,
        'name' => 'role.edit',
        'pid' => 'role',
        'control' => '{"allow": ["node@admin.role/save", "node@admin.role/savepermission"]}',
        'desc' => '编辑角色',
    ],
    [
        'id' => 16,
        'genre' => 1,
        'sort' => 0,
        'name' => 'role.info',
        'pid' => 'role',
        'control' => '{"allow": ["node@admin.role/index", "node@admin.role/table", "node@admin.role/pageedit", "node@admin.role/permission"]}',
        'desc' => '查看角色',
    ],
    [
        'id' => 17,
        'genre' => 1,
        'sort' => 0,
        'name' => 'user',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '用户',
    ],
    [
        'id' => 18,
        'genre' => 1,
        'sort' => 0,
        'name' => 'user.del',
        'pid' => 'user',
        'control' => '{"allow": ["node@admin.manager/delete"]}',
        'desc' => '删除用户',
    ],
    [
        'id' => 19,
        'genre' => 1,
        'sort' => 0,
        'name' => 'user.edit',
        'pid' => 'user',
        'control' => '{"allow": ["node@admin.manager/save"]}',
        'desc' => '编辑用户',
    ],
    [
        'id' => 20,
        'genre' => 1,
        'sort' => 0,
        'name' => 'user.info',
        'pid' => 'user',
        'control' => '{"allow": ["node@admin.manager/index", "node@admin.manager/table", "node@admin.manager/pageedit"]}',
        'desc' => '查看用户',
    ],
    [
        'id' => 21,
        'genre' => 1,
        'sort' => 0,
        'name' => 'user.password',
        'pid' => 'user',
        'control' => '{"allow": ["node@admin.manager/changepassword"]}',
        'desc' => '更改密码',
    ],
    [
        'id' => 22,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.main',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '',
    ],
    [
        'id' => 23,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.main/clearcache',
        'pid' => 'node@admin.main',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Main::clearCache", "policy": "userType:admin"}',
        'desc' => '',
    ],
    [
        'id' => 24,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.main/index',
        'pid' => 'node@admin.main',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Main::index", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 25,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.main/sysinfo',
        'pid' => 'node@admin.main',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Main::sysinfo", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 26,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.manager',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '',
    ],
    [
        'id' => 27,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.manager/changepassword',
        'pid' => 'node@admin.manager',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Manager::changePassword", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 28,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.manager/delete',
        'pid' => 'node@admin.manager',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Manager::delete", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 29,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.manager/index',
        'pid' => 'node@admin.manager',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Manager::index", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 30,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.manager/pageedit',
        'pid' => 'node@admin.manager',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Manager::pageEdit", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 31,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.manager/save',
        'pid' => 'node@admin.manager',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Manager::save", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 32,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.manager/table',
        'pid' => 'node@admin.manager',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Manager::table", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 33,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.menu',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '',
    ],
    [
        'id' => 34,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.menu/delete',
        'pid' => 'node@admin.menu',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Menu::delete", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 35,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.menu/edit',
        'pid' => 'node@admin.menu',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Menu::edit", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 36,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.menu/export',
        'pid' => 'node@admin.menu',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Menu::export", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 37,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.menu/index',
        'pid' => 'node@admin.menu',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Menu::index", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 38,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.menu/save',
        'pid' => 'node@admin.menu',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Menu::save", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 39,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.menu/table',
        'pid' => 'node@admin.menu',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Menu::table", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 40,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '',
    ],
    [
        'id' => 41,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission/del',
        'pid' => 'node@admin.permission',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Permission::del", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 42,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission/edit',
        'pid' => 'node@admin.permission',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Permission::edit", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 43,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission/get',
        'pid' => 'node@admin.permission',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Permission::get", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 44,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission/index',
        'pid' => 'node@admin.permission',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Permission::index", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 45,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission/lasting',
        'pid' => 'node@admin.permission',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Permission::lasting", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 46,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission/permissiontree',
        'pid' => 'node@admin.permission',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Permission::permissionTree", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 47,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission/save',
        'pid' => 'node@admin.permission',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Permission::save", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 48,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.permission/scan',
        'pid' => 'node@admin.permission',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Permission::scan", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 49,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.role',
        'pid' => '__ROOT__',
        'control' => null,
        'desc' => '',
    ],
    [
        'id' => 50,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.role/delete',
        'pid' => 'node@admin.role',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Role::delete", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 51,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.role/index',
        'pid' => 'node@admin.role',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Role::index", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 52,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.role/pageedit',
        'pid' => 'node@admin.role',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Role::pageEdit", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 53,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.role/permission',
        'pid' => 'node@admin.role',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Role::permission", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 54,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.role/save',
        'pid' => 'node@admin.role',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Role::save", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 55,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.role/savepermission',
        'pid' => 'node@admin.role',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Role::savePermission", "policy": ""}',
        'desc' => '',
    ],
    [
        'id' => 56,
        'genre' => 2,
        'sort' => 0,
        'name' => 'node@admin.role/table',
        'pid' => 'node@admin.role',
        'control' => '{"class": "app\\\\controller\\\\admin\\\\Role::table", "policy": ""}',
        'desc' => '',
    ],
];
