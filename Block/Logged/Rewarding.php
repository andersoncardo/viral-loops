<?php

namespace Cardoso\ViralLoops\Block\Logged;


use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Cardoso\ViralLoops\Model\Rewarding\Management\Transaction;
use Cardoso\ViralLoops\Model\Config;

class Rewarding extends \Magento\Framework\View\Element\Template
{

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var Transaction
     */
    protected $rewardingManagement;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;


    /**
     * Constructor
     *
     * @param Context $context
     * @param Session $session
     * @param Config $config
     * @param Transaction $rewardingManagement
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        Session $session,
        Config  $config,
        Transaction $rewardingManagement,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->session = $session;
        $this->config = $config;
        $this->rewardingManagement = $rewardingManagement;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->session->getCustomer();
    }

    /**
     * @return false|int|Transaction|null
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function manageRewarding()
    {
        if (!$this->isEnable()) {
            return null;
        }
        $customer = $this->session->getCustomer();
        return $this->rewardingManagement->manageRewarding($customer);
    }

    /**
     * @return string
     */
    public function getCampaignId()
    {
        return $this->config->getCampaignId();
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function isEnable()
    {
        $store = $this->storeManager->getStore();
        $storeId = $store->getId();
        return $this->config->isEnable('store', $storeId);
    }
}

