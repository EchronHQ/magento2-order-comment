define([
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/url',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Checkout/js/model/full-screen-loader',
        'mage/storage',
        'Magento_Checkout/js/model/business-order',
        'Echron_OrderComment/js/model/checkout/order-comment'
    ], function (customer, quote, urlBuilder, urlFormatter, errorProcessor, fullScreenLoader, storage, businessOrder, orderComment) {
        'use strict';

        return {

            /**
             * Make an ajax PUT request to store the order comment in the quote.
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
                var result = true;

                fullScreenLoader.startLoader();

                storage.put(
                    urlFormatter.build(url),
                    JSON.stringify(payload),
                    false
                ).done(function () {
                    result = true;
                }).fail(function (response) {
                    result = false;
                    errorProcessor.process(response);
                }).always(function () {
                    fullScreenLoader.stopLoader();
                });

                return result;
            }
        };
    }
);
