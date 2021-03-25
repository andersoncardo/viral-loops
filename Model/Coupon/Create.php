<?php

namespace Cardoso\ViralLoops\Model\Coupon;

use Cardoso\ViralLoops\Helper\Cookie;
use Cardoso\ViralLoops\Model\Config;
use Psr\Log\LoggerInterface;
use Magento\SalesRule\Api\Data\CouponInterface;
use Magento\Framework\Exception\InputException;
use Magento\SalesRule\Api\RuleRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\SalesRule\Api\CouponRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\SalesRule\Api\Data\RuleInterfaceFactory;

class Create
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CouponRepositoryInterface
     */
    protected $couponRepository;

    /**
     * @var RuleRepositoryInterface
     */
    protected $ruleRepository;

    /**
     * @var RuleInterfaceFactory
     */
    protected $rule;

    /**
     * @var CouponInterface
     */
    protected $coupon;

    /**
     * @var Cookie
     */
    protected $referralCookie;

    /**
     * @var Config
     */
    protected $config;

    /**
     * Create constructor.
     * @param CouponRepositoryInterface $couponRepository
     * @param RuleRepositoryInterface $ruleRepository
     * @param RuleInterfaceFactory $rule
     * @param CouponInterface $coupon
     * @param LoggerInterface $logger
     * @param Cookie $referralCookie
     * @param Config $config
     */
    public function __construct(
        CouponRepositoryInterface $couponRepository,
        RuleRepositoryInterface $ruleRepository,
        RuleInterfaceFactory $rule,
        CouponInterface $coupon,
        LoggerInterface $logger,
        Cookie $referralCookie,
        Config $config
    ) {
        $this->couponRepository = $couponRepository;
        $this->ruleRepository = $ruleRepository;
        $this->rule = $rule;
        $this->coupon = $coupon;
        $this->logger = $logger;
        $this->referralCookie = $referralCookie;
        $this->config = $config;
    }

    /**
     * Create Coupon by Rule id.
     *
     * @param array $couponBody
     * @return int|null
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function createCoupon(array $couponBody): ?int
    {
        $coupon = $this->coupon;
        $coupon->setCode($couponBody['code'])
            ->setUsageLimit(0)
            ->setCreatedAt($couponBody['createdAt'])
            ->setUsagePerCustomer(1)
            ->setTimesUsed(0)
            ->setType(1)
            ->setRuleId($couponBody['ruleId']);
        /** @var CouponRepositoryInterface $couponRepository */
        $coupon = $this->couponRepository->save($coupon);
        return $coupon->getCouponId();
    }
}
