<?php

return [
    'routes' => [
        ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
        
        // API Routes
        ['name' => 'item_api#index', 'url' => '/items', 'verb' => 'GET'],
        ['name' => 'item_api#show', 'url' => '/items/{id}', 'verb' => 'GET'],
        ['name' => 'item_api#create', 'url' => '/items', 'verb' => 'POST'],
        ['name' => 'item_api#update', 'url' => '/items/{id}', 'verb' => 'PUT'],
        ['name' => 'item_api#destroy', 'url' => '/items/{id}', 'verb' => 'DELETE'],
    ],
];
