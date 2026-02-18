<?php
declare(strict_types=1);

namespace Echron\OrderComment\Api;

use Echron\OrderComment\Api\Data\OrderCommentInterface;

/**
 * Interface for saving the checkout order comment
 * to the quote for logged in users
 * @api
 */
interface OrderCommentManagementInterface
{
    /**
     * @param string $cartId
     * @param OrderCommentInterface $orderComment
     * @return null|string
     */
    public function saveOrderComment(
        string                $cartId,
        OrderCommentInterface $orderComment
    ): string|null;
}
