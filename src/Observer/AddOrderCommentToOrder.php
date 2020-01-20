<?php
declare(strict_types=1);

namespace Echron\OrderComment\Observer;

use Echron\OrderComment\Model\Data\OrderComment;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddOrderCommentToOrder implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        /** @var $order \Magento\Sales\Model\Order * */

        $quote = $observer->getEvent()->getQuote();
        /** @var $quote \Magento\Quote\Model\Quote * */

        $order->setData(
            OrderComment::COMMENT_FIELD_NAME,
            $quote->getData(OrderComment::COMMENT_FIELD_NAME)
        );
    }
}
