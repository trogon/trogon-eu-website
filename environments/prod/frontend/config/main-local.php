<?php
ini_set('session.use_cookies', '0');

return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
            'enableCsrfCookie' => false,
            'enableCookieValidation' => false,
        ],
    ],
];
