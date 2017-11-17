<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
		'storage' => [
			'class' => 'insma\storage\StorageModule',
			'localStorageDir' => '@common/data/uploads',
			'webAccessUrl' => false,
		],
        'redactor' => [
			'class' => 'yii\redactor\RedactorModule',
			'imageUploadRoute' => ['storage/image/upload'],
			'fileUploadRoute' => ['storage/file/upload'],
			'imageManagerJsonRoute' => ['storage/image/json-index'],
			'fileManagerJsonRoute' => ['storage/file/json-index'],
		],
    ],
];
