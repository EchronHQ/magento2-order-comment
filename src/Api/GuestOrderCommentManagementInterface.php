<?php
declare(strict_types=1);

namespace Echron\OrderComment\Api;

use Echron\OrderComment\Api\Data\OrderCommentInterface;

/**
 * Interface for saving the checkout order comment
 * to the quote for guest users
 * @api
 */
interface GuestOrderCommentManagementInterface
{
    /**
     * @param string $cartId
     * @param OrderCommentInterface $orderComment
     * @return string|null
     */
    public function saveOrderComment(
        string                $cartId,
        OrderCommentInterface $orderComment
    ): string|null;
}
