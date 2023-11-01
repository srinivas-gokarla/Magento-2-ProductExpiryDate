<?php

namespace Srinivas\ProductExpiryDate\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\View\Element\Template\Context;
use Srinivas\ProductExpiryDate\Helper\Config;

class CartItemInfo extends Template
{
    private TimezoneInterface $timezoneInterface;
    private Config $config;

    /**
     * @param Context $context
     * @param TimezoneInterface $timezoneInterface
     * @param array $data
     */
    public function __construct(
        Template\Context  $context,
        TimezoneInterface $timezoneInterface,
        Config            $config,
        array             $data = [])
    {
        parent::__construct($context, $data);
        $this->timezoneInterface = $timezoneInterface;
        $this->config = $config;
    }

    public function getChildProduct()
    {
        if ($option = $this->getItem()->getOptionByCode('simple_product')) {
            return $option->getProduct();
        }
        return $this->getProduct();
    }

    public function getStoreDateTime()
    {
        return $this->timezoneInterface->date()->format('Y-m-d H:i:s');
    }

    public function getNoticeMessage()
    {
        return $this->config->getErrorMessage();
    }

    /**
     * @return ScopeConfigInterface
     */
    public function isEnabled()
    {
        return $this->config->isEnabled();
    }

}
