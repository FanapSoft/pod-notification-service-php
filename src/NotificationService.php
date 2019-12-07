<?php
/**
 * Created by PhpStorm.
 * User: keshtgar
 * Date: 8/11/19
 * Time: 12:33 PM
 */
namespace Pod\Notification\Service;

use Pod\Base\Service\BaseService;
use Pod\Base\Service\ApiRequestHandler;


class NotificationService extends BaseService
{
    private $header;
    private static $notificationApi;
    private static $baseUri;
    private static $serviceProductId;

    public function __construct($baseInfo)
    {
        parent::__construct();
        self::$jsonSchema = json_decode(file_get_contents(__DIR__ . '/../config/jsonSchema.json'), true);
        $this->header = [
            '_token_issuer_'    =>  $baseInfo->getTokenIssuer(),
            '_token_'           => $baseInfo->getToken(),
            'content-type'      => 'application/x-www-form-urlencoded' # set content type to form-urlencoded
        ];
        self::$notificationApi = require __DIR__ . '/../config/apiConfig.php';
        self::$serviceProductId = require __DIR__ . '/../config/serviceCallProductId.php';
        self::$serviceProductId = self::$serviceProductId[self::$serverType];
        self::$baseUri = self::$config[self::$serverType];
    }

    public function sendSMS($params) {
        $apiName = 'sendSMS';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];
        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        $preparedJsonBody['content'] = $option[$paramKey]['content'];
        if (isset($option[$paramKey]['serviceName'])) {
            $preparedJsonBody['serviceName'] = $option[$paramKey]['serviceName'];
        }

        $option[$paramKey]['body'] = json_encode($preparedJsonBody);

        unset($option[$paramKey]['content']);

        if(isset($option[$paramKey]['serviceName'])){
            unset($option[$paramKey]['serviceName']);
        }

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function getSMSStatus($params) {
        $apiName = 'getSMSStatus';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];
        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];
        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }
        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function sendValidationSMS($params) {
        $apiName = 'sendValidationSMS';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];
        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        $preparedJsonBody['content'] = $option[$paramKey]['content'];
        $option[$paramKey]['body'] = json_encode($preparedJsonBody);

        unset($option[$paramKey]['content']);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function getValidationSMSStatus($params) {
        $apiName = 'getValidationSMSStatus';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function getSMSList($params) {
        $apiName = 'getSMSList';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function sendEmail($params) {
        $apiName = 'sendEmail';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];
        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        $preparedJsonBody['content'] = $option[$paramKey]['content'];
        if (isset($option[$paramKey]['serviceName'])) {
            $preparedJsonBody['serviceName'] = $option[$paramKey]['serviceName'];
        }

        $option[$paramKey]['body'] = json_encode($preparedJsonBody);

        unset($option[$paramKey]['content']);

        if(isset($option[$paramKey]['serviceName'])){
            unset($option[$paramKey]['serviceName']);
        }

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function getEmailList($params) {
        $apiName = 'getEmailList';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function getEmailInfo($params) {
        $apiName = 'getEmailInfo';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function pushNotificationByPeerId($params) {
        $apiName = 'pushNotificationByPeerId';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];
        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        $preparedJsonBody['content'] = $option[$paramKey]['content'];
        $option[$paramKey]['body'] = json_encode($preparedJsonBody);
        unset($option[$paramKey]['content']);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function pushNotificationByAppId($params) {
        $apiName = 'pushNotificationByAppId';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];
        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        $preparedJsonBody['content'] = $option[$paramKey]['content'];
        $option[$paramKey]['body'] = json_encode($preparedJsonBody);
        unset($option[$paramKey]['content']);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function getPushNotificationStatus($params) {
        $apiName = 'getPushNotificationStatus';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        switch ($params["statusType"]) {
            case 'Seen':
            case 'seen':
                $apiNameBasedStatusType = 'getPushNotificationStatusSeen';
                break;
            case 'Received':
            case 'received':
                $apiNameBasedStatusType = 'getPushNotificationStatusReceived';
                break;
            case 'All':
            case 'all':
            default:
                $apiNameBasedStatusType = 'getPushNotificationStatusAll';
        }

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiNameBasedStatusType];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function getPushNotificationList($params) {
        $apiName = 'getPushNotificationList';
        $optionHasArray = false;
        $header = $this->header;

        if(isset($params['token'])) {
            $header["apiToken"] = $params['token'];
            $header["_token_"] = $params['token'];
            unset($params['token']);
        } else {
            $header["apiToken"] = $header["_token_"];
        }

        $method = self::$notificationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);

        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$baseUri[self::$notificationApi[$apiName]['baseUri']],
            $method,
            self::$notificationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }
}