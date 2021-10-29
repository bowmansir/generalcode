<?php
namespace GeneralCode;

use GeneralCode\Core\ServiceContainer;
use GeneralCode\Core\Exceptions\InvalidArgumentException;

/**
 * @property Sign\Sign $sign 签名服务
 * @property Message\Message $message 消息服务
 *
 * Class GeneralCode
 * @package GeneralCode
 * @author bowser <s4p3r.code@gmail.com>
 */
class GeneralCode extends ServiceContainer
{
    /**
     * @var array
     */
    protected $serviceProviders = [
        Sign\ServiceProvider::class,
        Message\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'access_token' => '', // require
        'secret' => '',
        'gateway' => 'https://oapi.dingtalk.com/robot/send',
        'app_secret' => '',
        'guzzle_options' => [],
    ];

    /**
     * GeneralCode constructor.
     * @param array $config
     * @throws InvalidArgumentException
     */
    public function __construct(array $config)
    {
        parent::__construct();

        $this->setConfig($config);
    }

    /**
     * @param array $config
     * @return GeneralCode
     * @throws InvalidArgumentException
     */
    public function setConfig(array $config): self
    {
        if (empty($config['access_token'])) {
            throw new InvalidArgumentException('access_token could not be empty');
        }

        $this['config'] = array_merge($this->defaultConfig, $config);

        return $this;
    }
}
