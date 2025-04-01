<?php

return [
    'random_user' => [
        'url' => env('RANDOM_USER_API_URL', 'https://randomuser.me/api'),
        'nationality' => env('REQUIRED_NATIONALITY', 'AU'),
        'results' => env('DEFAULT_RESULTS', 100),
    ],
];