<?php
declare(strict_types=1);

namespace Echron\OrderComment\Api\Data;

/**
 * Interface OrderCommentInterface
 * @api
 */
interface OrderCommentInterface
{
    /**
     * @return string|null
     */
    public function getComment(): string|null;

    /**
     * @param string $comment
     * @return void
     */
    public function setComment(string $comment): void;
}
