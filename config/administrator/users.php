<?php

use App\Models\User;

return [
    // 页面标题
    'title' =>  '用户',

    // 模型单数,用作页面新建$single
    'single' => '用户',

    // 数据模型,用作数据的CURD
    'model' => User::class,

    // 设置当前页面的访问权限,通过返回布尔值来在控制权限
    // 返回True即通过权限验证,False则无权访问并从Menu中隐藏
    'permission' => function()
    {
        return Auth::user()->can('manage_users');
    },

    // 字段负责渲染数据表格,由无数的列组成
    'columns' => [
        // 列的标识,这是一个最小化列信息配置的例子,读取的是模型里对应的属性值
        'id',
        'avatar' => [
            // 数据表格里列的名称,默认会使用列标识
            'title' => '头像',
            // 默认情况下直接输出数据,也可以使用output选项定制输出内容
            'output' => function($avatar,$model){
                return empty($avatar) ? 'N/A' : "<img src='$avatar' width='40'>";
            },
            // 是否允许排序
            'sortable' => false
        ],
        'name' => [
            'title' => '用户名',
            'sortable' => false,
            'output' => function($name,$model){
                return "<a href='/users/{$model->id}' target='_blank'>{$name}</a>";
            }
        ],
        'email' => [
            'title' => '邮箱'
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ]
    ],

    // 模型表单设置项
    'edit_fields' => [
        'name' => [
            'title' => '用户名'
        ],
        'email' => [
            'title' => '邮箱'
        ],
        'password' => [
            'title' => '密码',
            'type' => 'password'
        ],
        'avatar' => [
            'title' => '用户头像',
            'type' => 'image',
            'location' => public_path() . '/uploads/images/avatars/'
        ],
        'roles' => [
            'title' => '用户角色',
            // 指定数据的类型为关联模型
            'type' => 'relationship',
            // 关联模型的字段,用来做关联显示
            'name_field' => 'name',
        ],
    ],

    // 数据过滤设置
    'filters' => [
        'id' => [
            // 过滤表单条目显示名称
            'title' => '用户ID',
        ],
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱'
        ]
    ]
];