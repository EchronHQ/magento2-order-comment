<?php
declare(strict_types=1);

namespace Echron\OrderComment\Model\Data;

use Echron\OrderComment\Api\Data\OrderCommentInterface;
use Magento\Framework\Api\AbstractSimpleObject;

class OrderComment extends AbstractSimpleObject implements OrderCommentInterface
{
    public const COMMENT_FIELD_NAME = 'echron_order_comment';

    /**
     * @return string|null
     */
    public function getComment(): string|null
    {
        return $this->_get(static::COMMENT_FIELD_NAME);
    }

    /**
     * @param string $comment
     * @return void
     */
    public function setComment(string $comment): void
    {
        $this->setData(static::COMMENT_FIELD_NAME, $comment);
    }
}
