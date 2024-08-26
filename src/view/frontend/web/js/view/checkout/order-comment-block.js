define(['jquery', 'uiComponent'], function ($, Component) {
    'use strict';

    console.log('order comment js loaded');
    return Component.extend({
        defaults: {
            template: 'Echron_OrderComment/checkout/order-comment-block'
        }, initialize: function () {
            this._super();

            var config = window.checkoutConfig.orderComment;

            console.log('comment config', config);

            this.lineCount = config.lineCount;
            this.maxLength = config.maxLength;
            this.fieldLabel = config.fieldLabel;
            this.fieldPlaceholder = config.fieldPlaceholder;

            this.isSingleLine = this.lineCount === 1;

            return this;
        }
    });
});
