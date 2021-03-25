<?php


namespace Cardoso\ViralLoops\Model\Rewarding\Management;


use Magento\Customer\Model\Customer;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Cardoso\ViralLoops\Model\ResourceModel\ManagementRepository;
use Cardoso\ViralLoops\Model\ManagementFactory;

class Register
{
    /**
     * @var ManagementRepository
     */
    protected $managementRepository;
    protected $management;

    /**
     * Coupon constructor.
     * @param ManagementRepository $managementRepository
     * @param ManagementFactory $management
     */
    public function __construct(
        ManagementRepository $managementRepository,
        ManagementFactory $management
    ) {
        $this->managementRepository = $managementRepository;
        $this->management = $management;
    }

    /**
     * @param Customer $customer
     * @param $baseCoupon
     * @return Register
     * @throws AlreadyExistsException
     */
    public function create(Customer $customer, $baseCoupon): Register
    {
        if (!$baseCoupon) {
            return $this;
        }
        $managementTransactions = $this->management->create();
        $managementTransactions->setCouponCode($baseCoupon['code']);
        $managementTransactions->setReferralCodeCustomer($baseCoupon['referralCode']);
        $managementTransactions->setReferralCodeOrigin($baseCoupon['referralCode']);
        $managementTransactions->setCreatedAt($baseCoupon['createdAt']);
        $managementTransactions->setCustomerId($customer->getId());
        $managementTransactions->setCouponValue($baseCoupon['coupon_value']);
        $managementTransactions->setCouponId($baseCoupon['transaction_id']);
        $this->managementRepository->save($managementTransactions);
        return $this;
    }


    /**
     * @param $managementId
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function update($managementId)
    {
        $student = $this->managementRepository->getById($managementId);
        $student->setIsUsed(1);
        $this->managementRepository->save($student);
    }
}
