<?php
declare(strict_types=1);

namespace Echron\OrderComment\Block\Order;

use Echron\OrderComment\Model\Data\OrderComment;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\Order;
use Magento\Store\Model\ScopeInterface;

class Comment extends Template
{
    /**
     *  Config Path
     */
    public const XML_PATH_GENERAL_IS_SHOW_IN_MYACCOUNT = 'order_comment/general/is_show_in_myaccount';
    public const XML_PATH_GENERAL_FIELD_NAME = 'order_comment/general/field_name';
    public const XML_PATH_GENERAL_LINE_COUNT = 'order_comment/general/line_count';
    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @var Registry
     */
    protected Registry $coreRegistry;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Context              $context,
        Registry             $registry,
        ScopeConfigInterface $scopeConfig,
        array                $data = []
    )
    {
        $this->coreRegistry = $registry;
        $this->scopeConfig = $scopeConfig;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/comment.phtml';
        parent::__construct($context, $data);
    }

    /**
     * Check if show order comment to customer account
     *
     * @return bool
     */
    public function isShowCommentInAccount(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_IS_SHOW_IN_MYACCOUNT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get comment field name (default 'Order comment')
     *
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_FIELD_NAME,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get line count
     *
     * @return int
     */
    public function getLineCount(): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_LINE_COUNT,
            ScopeInterface::SCOPE_STORE
        );
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
