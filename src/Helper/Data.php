<?php
declare(strict_types=1);

namespace Echron\OrderComment\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     *  Config Path
     */
    public const XML_PATH_GENERAL_SHOW_IN_MYACCOUNT = 'order_comment/general/show_in_myaccount';

    public const XML_PATH_GENERAL_FIELD_LABEL = 'order_comment/field/label';
    public const XML_PATH_GENERAL_FIELD_PLACEHOLDER = 'order_comment/field/placeholder';
    public const XML_PATH_GENERAL_FIELD_LINE_COUNT = 'order_comment/field/line_count';
    public const XML_PATH_GENERAL_FIELD_MAX_LENGTH = 'order_comment/field/max_length';

    private \Echron\OrderComment\Helper\Data $dataHelper;


    /**
     * Check if show order comment to customer account
     *
     * @return bool
     */
    public function isShowCommentInAccount(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_SHOW_IN_MYACCOUNT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get comment field label (default 'Order comment')
     *
     * @return string
     */
    public function getFieldLabel(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_FIELD_LABEL,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get comment field placeholder (default 'Order comment')
     *
     * @return string
     */
    public function getFieldPlaceholder(): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_FIELD_PLACEHOLDER,
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
        return 1;
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_FIELD_LINE_COUNT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get max length
     *
     * @return int
     */
    public function getMaxLength(): int|null
    {
        $value = $this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_FIELD_MAX_LENGTH,
            ScopeInterface::SCOPE_STORE
        );
        return $value === null ? null : (int)$value;
    }
}
