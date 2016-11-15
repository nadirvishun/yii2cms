<?php
return [
 	'name'=>'Vishun\'s website',
    	'language'=>'zh-CN',
    	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    	'components' => [
    	   'cache' => [
            	       'class' => 'yii\caching\FileCache',
        	   ],
        	   'formatter' => [
        		'dateFormat' => 'yyyy-MM-dd',
        		'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
        		'decimalSeparator' => ',',
        		'thousandSeparator' => ' ',
        		'currencyCode' => 'CNY',
    	  ],
    	],
];
