<?php
namespace wzzwx\yii2DingtalkRobot;

use yii\base\Component;
use DingNotice\DingTalk;

class Client extends Component
{
    public $client;

    public $params = [];

    public function init()
    {
        if (!is_array($this->params) || empty($this->params) || empty($this->params['default'])) {
            throw new \Exception('params参数错误');
        }
        $default = [
            'enabled' => true,
            'timeout' => 2.0,
            'ssl_verify' => true,
            'secret' => '',
        ];
        $params = [];
        foreach ($this->params as $key => $item) {
            if (empty($item['token'])) {
                throw new \Exception('params参数错误');
            }
            $params[$key] = array_merge($default, $item);
        }

        $this->client = new DingTalk($params);
        return parent::init();
    }

    public function __call($name,$args)
    {
        return call_user_func_array([$this->client, $name], $args);
    }
}