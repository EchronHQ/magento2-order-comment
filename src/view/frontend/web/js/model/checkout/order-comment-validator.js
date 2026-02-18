define([
    'Magento_Customer/js/model/customer',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/url-builder',
    'mage/url',
    'Magento_Checkout/js/model/error-processor',
    'jquery',
    'Echron_OrderComment/js/model/checkout/order-comment'
], function (customer, quote, urlBuilder, urlFormatter, errorProcessor, $, orderComment) {
    'use strict';

    return {
        /**
         * Save the order comment to the quote via REST API.
         *
         * Uses a synchronous XHR so the result is available before returning.
         * The Magento additional-validators interface is synchronous and cannot
         * handle a deferred/promise return value.
         *
         * @returns {Boolean}
         */
        validate: function () {
            var comment = orderComment.comment();

            if (!comment) {
                return true;
            }

            var quoteId = quote.getQuoteId();
            var url;

            if (customer.isLoggedIn()) {
                url = urlBuilder.createUrl('/carts/mine/set-order-comment', {});
            } else {
                url = urlBuilder.createUrl('/guest-carts/:cartId/set-order-comment', {cartId: quoteId});
            }

            var payload = {
                cartId: quoteId,
                orderComment: {
                    comment: comment
                }
            };

            var result = false;

            $.ajax({
                url: urlFormatter.build(url),
                type: 'PUT',
                data: JSON.stringify(payload),
                contentType: 'application/json',
                async: false,
                success: function () {
                    result = true;
                },
                error: function (response) {
                    errorProcessor.process(response);
                }
            });

            return result;
        }
    };
});
