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
     * @var QuoteIdMaskFactory
     */
    protected QuoteIdMaskFactory $quoteIdMaskFactory;

    /**
     * @var OrderCommentManagementInterface
     */
    protected QuoteIdMaskFactory $orderCommentManagement;

    /**
     * GuestOrderCommentManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param OrderCommentManagementInterface $orderCommentManagement
     */
    public function __construct(
        QuoteIdMaskFactory              $quoteIdMaskFactory,
        OrderCommentManagementInterface $orderCommentManagement
    )
    {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->orderCommentManagement = $orderCommentManagement;
    }

    /**
     * {@inheritDoc}
     */
    public function saveOrderComment(
        $cartId,
        OrderCommentInterface $orderComment
    ): string
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create()
            ->load($cartId, 'masked_id');

        return $this->orderCommentManagement->saveOrderComment(
            $quoteIdMask->getQuoteId(),
            $orderComment
        );
    }
}
