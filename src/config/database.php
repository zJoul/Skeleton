<?php

return [
    'driver' => getenv('DATABASE_DRIVER'),
    'name' => getenv('DATABASE_NAME'),
    'host' => getenv('DATABASE_HOST'),
    'user' => getenv('DATABASE_USER'),
    'password' => getenv('DATABASE_PASSWORD')
];