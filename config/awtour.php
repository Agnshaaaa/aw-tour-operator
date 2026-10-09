<?php

return [
    // Set a private, non-obvious path in the deployment environment.
    // This is an extra layer of obscurity, not a replacement for authentication.
    'admin_path' => env('ADMIN_PATH', 'admin'),
];
