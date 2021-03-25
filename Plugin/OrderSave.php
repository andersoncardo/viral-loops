<?php


namespace Cardoso\ViralLoops\Plugin;


use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Cardoso\ViralLoops\Model\Config;
use Cardoso\ViralLoops\Model\Rewarding\Management\Order\CouponRedeemed;

class OrderSave
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var CouponRedeemed
     */
    protected $couponRedeemed;

    /**
     * OrderSave constructor.
     * @param Config $config
     * @param CouponRedeemed $couponRedeemed
     */
    public function __construct(
        Config $config,
        CouponRedeemed $couponRedeemed
    ) {
        $this->config = $config;
        $this->couponRedeemed = $couponRedeemed;
    }


    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $resultOrder
     * @return OrderInterface
     * @throws AlreadyExistsException
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function afterSave(OrderRepositoryInterface $subject, OrderInterface $resultOrder): OrderInterface
    {
        if (!$this->config->isEnable()) {
            return $resultOrder;
        }
        if (!$resultOrder->getCouponCode()) {
            return $resultOrder;
        }

        if ($resultOrder->getPayment()->getMethod() == 'mundipagg_billet') {
            return $resultOrder;
        }
        $this->couponRedeemed->manageCouponIsRedeemed($resultOrder);

        return $resultOrder;
    }

}
