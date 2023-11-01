<?php

namespace Srinivas\ProductExpiryDate\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config
{
    const XML_PATH_ERROR_MESSAGE = 'expirydate/settings/display_text';
    const XML_PATH_STATUS = 'expirydate/settings/enable';
    private ScopeConfigInterface $scopeConfigInterface;
    private StoreManagerInterface $storeManagerInterface;

    public function __construct(
        ScopeConfigInterface  $ScopeConfigInterface,
        StoreManagerInterface $StoreManagerInterface,
    )
    {
        $this->scopeConfigInterface = $ScopeConfigInterface;
        $this->storeManagerInterface = $StoreManagerInterface;
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getErrorMessage()
    {
        return $this->scopeConfigInterface->getValue(self::XML_PATH_ERROR_MESSAGE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManagerInterface->getStore()->getStoreId());
    }


    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function isEnabled()
    {
        return $this->scopeConfigInterface->getValue(self::XML_PATH_STATUS,
            ScopeInterface::SCOPE_STORE,
            $this->storeManagerInterface->getStore()->getStoreId());
    }
}
