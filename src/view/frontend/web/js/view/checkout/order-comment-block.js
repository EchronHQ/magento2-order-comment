define([
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/payment/additional-validators',
    'Echron_OrderComment/js/model/checkout/order-comment-validator',
    'Echron_OrderComment/js/model/checkout/order-comment'
], function (ko, Component, additionalValidators, commentValidator, orderComment) {
    'use strict';

    additionalValidators.registerValidator(commentValidator);

    return Component.extend({
        defaults: {
            template: 'Echron_OrderComment/checkout/order-comment-block',
            visible: true
        },

        initObservable: function () {
            this._super().observe(['visible']);
            return this;
        },

        initialize: function () {
            this._super();

            var config = window.checkoutConfig.orderComment;

            this.lineCount = config.lineCount;
            this.maxLength = config.maxLength;
            this.fieldLabel = config.fieldLabel;
            this.fieldPlaceholder = config.fieldPlaceholder;
            this.isSingleLine = this.lineCount === 1;
            this.comment = orderComment.comment;

            return this;
        }
    });
});
