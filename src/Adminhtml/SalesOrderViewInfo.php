<?php
namespace Echron\OrderComment\Plugin\Block\Adminhtml;

use Magento\Sales\Block\Adminhtml\Order\View\Info as ViewInfo;
use Echron\OrderComment\Model\Data\OrderComment;

class SalesOrderViewInfo
{
    /**
     * @param ViewInfo $subject
     * @param string $result
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterToHtml(
        ViewInfo $subject,
        $result
    ) {
        $commentBlock = $subject->getLayout()
            ->getBlock('order_comments');

        if ($commentBlock !== false) {
            $commentBlock->setOrderComment($subject->getOrder()
                ->getData(OrderComment::COMMENT_FIELD_NAME));
            $result = $result . $commentBlock->toHtml();
        }

        return $result;
    }
}
