<?php

return [
    'results_view' => [
        'type'     => 'POST',
        'route'    => '/results/[*:hash]',
        'callback' => 'App\Controller\MainController::renderResultsAction'
    ],
    'poll_acting_form' => [
        'type'     => ['GET', 'POST'],
        'route'    => '/poll/[*:hash]',
        'callback' => 'App\Controller\MainController::pollActingAction'
    ],
    'poll_builder_form' => [
        'type'     => ['GET', 'POST'],
        'route'    => '/',
        'callback' => 'App\Controller\MainController::pollBuilderAction'
    ],
];
