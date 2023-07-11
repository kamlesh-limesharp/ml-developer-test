<?php

namespace ML\DeveloperTest\Observer;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use ML\DeveloperTest\Helper\Data;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Message\ManagerInterface;

/**
 * RestrictAddToCart class
 */
class RestrictAddToCart implements ObserverInterface
{
    /**
     * @var Data
     */
    protected Data $helper;

    /**
     * @var Curl
     */
    protected Curl $curl;

    /**
     * @var $getCountryResult
     */
    protected $getCountryResult;

    /**
     * @var ManagerInterface
     */
    protected ManagerInterface $messageManager;

    /**
     * Constructor
     *
     * @param Data $helper
     * @param Curl $curl
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Data $helper,
        Curl $curl,
        ManagerInterface $messageManager
    ){
        $this->helper = $helper;
        $this->curl = $curl;
        $this->messageManager = $messageManager;
    }
    /**
     * Execute method
     *
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        if ($this->helper->isEnable()) {
            $getProduct = $observer->getProduct()->getData();
            $getCurrentCountry = $this->getCurrentCountry();
            $getSelectedCountry = $this->getRestrictedCountriesFromProduct($getProduct);
            if (in_array($getCurrentCountry, $getSelectedCountry)) {
                $message = __(
                    $this->helper->getNoticeMessage() . ' %1 .',
                    $this->getCountryResult->country_name
                );
                throw new LocalizedException($message);
            }
        }
    }

    /**
     * Get current country try to add product to cart
     *
     * @throws LocalizedException
     */
    private function getCurrentCountry() {
        try {
            $url = $this->helper->getApiUrl() . "?access_key=" . $this->helper->getApiKey();
            $this->curl->get($url);
            $this->getCountryResult = json_decode($this->curl->getBody());
            $country = '';
            if ($this->getCountryResult) {
                $country =  ($this->getCountryResult->country_code) ? : $country;
            }
            return $country;
        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }
    }

    /**
     * Get restricted countries list from assigned product
     *
     * @param $product
     * @return string|string[]
     */
    private function getRestrictedCountriesFromProduct($product): array|string
    {
        return ($product['restrict_countries']) ? array_values(explode(',', $product['restrict_countries'])) : '';
    }
}
