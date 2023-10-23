<?php

return [
    //'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',

    // Фото
    
    'image/create' => 'image/create',  // actionCreate в ImageController

    'image/save' => 'image/save',  // actionSave в ImageController

    'image' => 'image/index',  // actionIndex в ImageController
    
    // Клиент

    'user/login' => 'user/login',  // actionLogin в UserController

    'user/logout' => 'user/logout',  // actionLogout в UserController

    'user/register' => 'user/register',  // actionRegister в UserController

    'user/login_process' => 'user/login_process',  // actionLogin_process в UserController

    'user/register_process' => 'user/register_process',  // actionRegister_process в UserController

    // Комментарии
    
    'comment/create' => 'comment/create', // actionCreate в CommentController

    'comment/save' => 'comment/save', // actionSave в CommentController

    'comment/([0-9]+)' => 'comment/view/$1', // actionView в CommentController
    
    // Альбом    

    'album/create' => 'album/create',  // actionCreate в AlbumController

    'album/save' => 'album/save',  // actionSave в AlbumController

    'album/([0-9]+)' => 'album/view/$1', //  actionView в AlbumController

    'album' => 'album/index',  // actionIndex в AlbumController

    // Главная страница

    '^$' => 'main/index',  // actionIndex в MainController
];
