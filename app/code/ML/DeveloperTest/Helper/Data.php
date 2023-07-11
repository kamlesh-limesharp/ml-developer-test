<?php
declare(strict_types=1);

namespace ML\DeveloperTest\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Dat helper
 */
class Data extends AbstractHelper
{
    const MODULE_ENABLE = 'developer-test/general/enabled';
    const NOTICE_MSG = 'developer-test/general/notice-msg';
    const API_KEY = 'developer-test/ip2-setting/api-key';
    const API_URL = 'developer-test/ip2-setting/api-url';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get store config value
     *
     * @return string
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check is enable
     *
     * @return string
     */
    public function isEnable($storeId = null)
    {
        return $this->getConfigValue(self::MODULE_ENABLE, $storeId);
    }

    /**
     * Get custom notice msg for display when add to art
     *
     * @param $storeId
     * @return string
     */
    public function getNoticeMessage($storeId = null)
    {
        return ($this->isEnable()) ? $this->getConfigValue(self::NOTICE_MSG, $storeId) : '';
    }

    /**
     * Get api key for ip2 country
     *
     * @param $storeId
     * @return string
     */
    public function getApiKey($storeId = null)
    {
        return ($this->isEnable()) ? $this->getConfigValue(self::API_KEY, $storeId) : '';
    }

    /**
     * Get api url
     *
     * @param $storeId
     * @return string
     */
    public function getApiUrl($storeId = null)
    {
        return ($this->isEnable()) ? $this->getConfigValue(self::API_URL, $storeId) : '';
    }
}

