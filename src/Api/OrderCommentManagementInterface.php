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
     * @param int $cartId
     * @param OrderCommentInterface $orderComment
     * @return null|string
     */
    public function saveOrderComment(
        int                   $cartId,
        OrderCommentInterface $orderComment
    ): string;
}
