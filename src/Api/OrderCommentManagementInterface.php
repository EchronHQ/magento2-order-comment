<?php
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
     * @return string
     */
    public function saveOrderComment(
        $cartId,
        OrderCommentInterface $orderComment
    );
}
