<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=trogoneuup1.mysql.db;dbname=trogoneuup1',
            'username' => 'trogoneuup1',
            'password' => 'OS7s4blxYp',
            'charset' => 'utf8',
            'tablePrefix' => 'ap1_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
