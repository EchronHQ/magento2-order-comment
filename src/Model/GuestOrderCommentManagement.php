<?php
declare(strict_types=1);

namespace Echron\OrderComment\Model;

use Echron\OrderComment\Api\Data\OrderCommentInterface;
use Echron\OrderComment\Api\GuestOrderCommentManagementInterface;
use Echron\OrderComment\Api\OrderCommentManagementInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;

class GuestOrderCommentManagement implements GuestOrderCommentManagementInterface
{

    /**
     * GuestOrderCommentManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param OrderCommentManagementInterface $orderCommentManagement
     */
    public function __construct(
        private QuoteIdMaskFactory              $quoteIdMaskFactory,
        private OrderCommentManagementInterface $orderCommentManagement
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function saveOrderComment(
        string                $cartId,
        OrderCommentInterface $orderComment
    ): string|null
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create()
            ->load($cartId, 'masked_id');

        return $this->orderCommentManagement->saveOrderComment(
            $quoteIdMask->getQuoteId(),
            $orderComment
        );
    }
}
