<?php
return [
    'sendSMS' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'POST'
    ],

    'getSMSStatus' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method'  => 'GET'
    ],

    'sendValidationSMS' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'POST'
    ],

    'getValidationSMSStatus' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'GET'
    ],

    'getSMSList' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'GET'
    ],

    'sendEmail' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'POST'
    ],

    'getEmailList' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'GET'
    ],

    'getEmailInfo' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'GET'
    ],

    'pushNotificationByPeerId' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'POST'
    ],

    'pushNotificationByAppId' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'POST'
    ],

    'getPushNotificationStatus' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'GET'
    ],

    'getPushNotificationList' => [
        'baseUri' => 'PLATFORM-ADDRESS',
        'subUri'  => 'nzh/doServiceCall',
        'method' => 'GET'
    ],

];