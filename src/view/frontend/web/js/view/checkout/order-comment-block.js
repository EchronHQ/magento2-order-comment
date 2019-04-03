define(
    [
        'jquery',
        'uiComponent'
    ],
    function ($, Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Echron_OrderComment/checkout/order-comment-block'
            }
        });
    }
);
