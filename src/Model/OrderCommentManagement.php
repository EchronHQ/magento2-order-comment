<?php
declare(strict_types=1);

namespace Echron\OrderComment\Model;

use Echron\OrderComment\Api\Data\OrderCommentInterface;
use Echron\OrderComment\Api\OrderCommentManagementInterface;
use Echron\OrderComment\Model\Data\OrderComment;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;

class OrderCommentManagement implements OrderCommentManagementInterface
{

    /**
     *
     * @param CartRepositoryInterface $quoteRepository
     */
    public function __construct(
        private CartRepositoryInterface $quoteRepository
    )
    {
    }

    /**
     * @inheritDoc
     *
     */
    public function saveOrderComment(
        string                $cartId,
        OrderCommentInterface $orderComment
    ): string|null
    {
        $quote = $this->quoteRepository->getActive($cartId);

        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(
                __('Cart %1 doesn\'t contain products', $cartId)
            );
        }

        $comment = $orderComment->getComment();

        try {
            $quote->setData(OrderComment::COMMENT_FIELD_NAME, \strip_tags($comment));

            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('The order comment could not be saved')
            );
        }

        return $comment;
    }
}
