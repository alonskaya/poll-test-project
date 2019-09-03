<?php

return [
    'index' => [
        'type'     => ['GET', 'POST'],
        'route'    => '/',
        'callback' => 'App\Controller\MainController::indexAction'
    ],

];
