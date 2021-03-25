<?php

namespace Cardoso\ViralLoops\Api;

use Magento\Store\Model\ScopeInterface;

/**
 * Interface CompanyConfigInterface
 * @package Cardoso\ViralLoops\Api
 */
interface ConfigInterface
{
    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return mixed
     */
    public function getToken($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null);

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return mixed
     */
    public function isEnable($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null);

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return mixed
     */
    public function getUrl($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null);

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return mixed
     */
    public function getRuleId($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null);

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return mixed
     */
    public function getRuleReferralId($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null);

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return mixed
     */
    public function getCampaignId($scopeType = ScopeInterface::SCOPE_WEBSITE, $scopeCode = null);
}
