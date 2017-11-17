<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
				'<_lang:\w{2}(\-\w{2})?>/privacy-policy/<appKey:[\w\-]+>' => 'privacy-policy/index',
				'privacy-policy/<appKey:[\w\-]+>' => 'privacy-policy/index',

				'<_lang:\w{2}(\-\w{2})?>/<controller:[\w\-]+>/<action:[\w\-]+>/item-<id:\d+>' => '<controller>/<action>',
				'<_lang:\w{2}(\-\w{2})?>/<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
				'<_lang:\w{2}(\-\w{2})?>/<controller:[\w\-]+>/item-<id:\d+>' => '<controller>/index',
				'<_lang:\w{2}(\-\w{2})?>/<controller:[\w\-]+>' => '<controller>/index',
				'<controller:[\w\-]+>/<action:[\w\-]+>/item-<id:\d+>' => '<controller>/<action>',
				'<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
				'<controller:[\w\-]+>/item-<id:\d+>' => '<controller>/index',
				'<controller:[\w\-]+>' => '<controller>/index',
            ],
        ],
    ],
    'params' => $params,
];
