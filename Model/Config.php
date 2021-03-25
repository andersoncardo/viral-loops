<?php

namespace Cardoso\ViralLoops\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Cardoso\ViralLoops\Api\ConfigInterface;

/**
 * Class CompanyConfig
 *
 * @package Trezo\DisableEditCompany\Model
 * @author Trezo
 * @version 1.0.0
 */
class Config implements ConfigInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig;

    /**
     * @var string
     */
    protected $xmlPathActive = 'ocean_drop_viral_loops/general/';


    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return string
     */
    public function getToken($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null)
    {
        $scopeCode = ($scopeCode) ? $scopeCode : 'token';
        return $this->getConfigValue($this->xmlPathActive . $scopeCode);
    }

    /**
     * @param string $scopeType
     * @param null $storeId
     * @param null $scopeCode
     * @return mixed
     */
    public function isEnable($scopeType = ScopeInterface::SCOPE_WEBSITE, $storeId = null, $scopeCode = null)
    {
        $scopeCode = ($scopeCode) ? : 'enable';
        return $this->getConfigValue($this->xmlPathActive . $scopeCode, $storeId);
    }

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return string
     */
    public function getUrl($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null)
    {
        $scopeCode = ($scopeCode) ? $scopeCode : 'url';
        return $this->getConfigValue($this->xmlPathActive . $scopeCode);
    }

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return string
     */
    public function getRuleId($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null)
    {
        $scopeCode = ($scopeCode) ? $scopeCode : 'rule_id';
        return $this->getConfigValue($this->xmlPathActive . $scopeCode);
    }

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return string
     */
    public function getRuleReferralId($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null)
    {
        $scopeCode = ($scopeCode) ? $scopeCode : 'rule_id_referral';
        return $this->getConfigValue($this->xmlPathActive . $scopeCode);
    }

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return string
     */
    public function getCampaignId($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null)
    {
        $scopeCode = ($scopeCode) ? $scopeCode : 'campaign_id';
        return $this->getConfigValue($this->xmlPathActive . $scopeCode);
    }

    /**
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }
}
