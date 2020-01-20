<?php
declare(strict_types=1);

namespace Echron\OrderComment\Block\Order;

use Echron\OrderComment\Model\Data\OrderComment;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\Order;
use Magento\Store\Model\ScopeInterface;

class Comment extends Template
{
    /**
     *  Config Path
     */
    public const XML_PATH_GENERAL_IS_SHOW_IN_MYACCOUNT = 'order_comment/general/is_show_in_myaccount';

    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @var Registry
     */
    protected Registry $coreRegistry = null;
    /**
     * @var true
     */
    private bool $_isScopePrivate;
    /**
     * @var string
     */
    private string $_template;

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
    public function isShowCommentInAccount()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_IS_SHOW_IN_MYACCOUNT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Order
     *
     * @return array|null
     */
    public function getOrder()
    {
        return $this->coreRegistry->registry('current_order');
    }

    /**
     * Get Order Comment
     *
     * @return string
     */
    public function getOrderComment()
    {
        return trim($this->getOrder()->getData(OrderComment::COMMENT_FIELD_NAME));
    }

    /**
     * Retrieve html comment
     *
     * @return string
     */
    public function getOrderCommentHtml()
    {
        return nl2br($this->escapeHtml($this->getOrderComment()));
    }

    /**
     * Check if has order comment
     *
     * @return bool
     */
    public function hasOrderComment()
    {
        return strlen($this->getOrderComment()) > 0;
    }
}
