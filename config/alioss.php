<?php
	//�������ϴ��ļ�����
	return [  
    'ossServer' => env('ALIOSS_SERVER', null),                      // ����
    'ossServerInternal' => env('ALIOSS_SERVERINTERNAL', null),      // ����
    'AccessKeyId' => env('ALIOSS_KEYID', null),                     // key
    'AccessKeySecret' => env('ALIOSS_KEYSECRET', null),             // secret
    'BucketName' => env('ALIOSS_BUCKETNAME', null)                  // bucket
];