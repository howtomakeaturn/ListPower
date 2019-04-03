<?php

return [

    'driver' => env('IMAGE_UPLOAD_DRIVER', 'local_file'),

    'local_file' => [
        'path' => env('IMAGE_UPLOAD_PATH', 'upload_photos/'),
    ],

    'cloudinary' => [
        'name' => env('CLOUDINARY_CLOUD_NAME'),
        'key' => env('CLOUDINARY_API_KEY'),
        'secret' => env('CLOUDINARY_API_SECRET'),
    ],

];
