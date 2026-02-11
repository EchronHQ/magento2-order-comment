<?php
declare(strict_types=1);

namespace Echron\OrderComment\Block\Order;

use Echron\OrderComment\Helper\Data;
use Echron\OrderComment\Model\Data\OrderComment;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Api\Data\OrderInterface;

class Comment extends Template
{

    protected Registry $coreRegistry;
    protected Data $dataHelper;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(
        Context  $context,
        Registry $registry,
        Data     $dataHelper,
        array    $data = []
    )
    {
        parent::__construct($context, $data);
        
        $this->coreRegistry = $registry;
        $this->dataHelper = $dataHelper;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/comment.phtml';

    }

    /**
     * Check if show order comment to customer account
     *
     * @return bool
     */
    public function isShowCommentInAccount(): bool
    {
        return $this->dataHelper->isShowCommentInAccount();
    }

    /**
     * Get comment field name (default 'Order comment')
     *
     * @return string
     */
    public function getFieldLabel(): string
    {
        return $this->dataHelper->getFieldLabel();
    }

    /**
     * Get Order
     *
     * @return OrderInterface|null
     */
    public function getOrder(): OrderInterface|null
    {
        return $this->coreRegistry->registry('current_order');
    }

    /**
     * Get Order Comment
     *
     * @return string
     */
    public function getOrderComment(): string
    {
        $order = $this->getOrder();
        if ($order) {
            return trim($order->getData(OrderComment::COMMENT_FIELD_NAME));
        }
        return '';
    }

    /**
     * Retrieve html comment
     *
     * @return string
     */
    public function getOrderCommentHtml(): string
    {
        return nl2br($this->escapeHtml($this->getOrderComment()));
    }

    /**
     * Check if has order comment
     *
     * @return bool
     */
    public function hasOrderComment(): bool
    {
        return strlen($this->getOrderComment()) > 0;
    }
}
