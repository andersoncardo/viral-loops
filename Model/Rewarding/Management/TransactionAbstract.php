<?php


namespace Cardoso\ViralLoops\Model\Rewarding\Management;


use Magento\Customer\Model\Customer;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Cardoso\ViralLoops\Helper\Cookie as CookieManager;
use Cardoso\ViralLoops\Model\Config;
use Cardoso\ViralLoops\Model\Connect\Api;
use Cardoso\ViralLoops\Model\Coupon\Create;
use Cardoso\ViralLoops\Model\Request\Event\Action;
use Cardoso\ViralLoops\Model\ResourceModel\ManagementRepository;

class TransactionAbstract
{
    const PATH_URL_ACTION = 'api/v2/events';
    const API_URL_ACTION = 'api/v2/';
    const REDEEMED_PATH = 'rewarded';
    const ACTION_PATH = 'events';
    const METHOD_GET = 'get';
    const METHOD_POST = 'POST';
    const REFERRAL_CODE = 'referralCode';
    const COOKIE_NAME = 'referralCodeViral';

    /**
     * @var Api
     */
    protected $connectApi;

    /**
     * @var CookieManager
     */
    protected $referralCookieManager;

    /**
     * @var Action
     */
    protected $eventAction;

    /**
     * @var Create
     */
    protected $coupon;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Coupon
     */
    protected $managementCoupon;

    /**
     * @var Register
     */
    protected $registerTransaction;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var ManagementRepository
     */
    protected $managementRepository;

    /**
     * Management constructor.
     * @param Api $connectApi
     * @param CookieManager $referralCookieManager
     * @param Action $eventAction
     * @param Create $coupon
     * @param Config $config
     * @param Coupon $managementCoupon
     * @param Register $registerTransaction
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ManagementRepository $managementRepository
     */
    public function __construct(
        Api $connectApi,
        CookieManager $referralCookieManager,
        Action $eventAction,
        Create $coupon,
        Config $config,
        Coupon $managementCoupon,
        Register $registerTransaction,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ManagementRepository $managementRepository
    ) {
        $this->connectApi = $connectApi;
        $this->referralCookieManager = $referralCookieManager;
        $this->eventAction = $eventAction;
        $this->coupon = $coupon;
        $this->config = $config;
        $this->managementCoupon = $managementCoupon;
        $this->registerTransaction = $registerTransaction;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->managementRepository = $managementRepository;
    }

    /**
     * @param $body
     * @param string $ruleId
     * @param $referralCodeOrigin
     * @param string $origin
     * @return array|false|string[]
     */
    protected function getBaseCoupon($body, string $ruleId, $referralCodeOrigin, $origin = 'action')
    {
        return $this->managementCoupon->prepareCoupon($body, $ruleId, $referralCodeOrigin, $origin);
    }
}
