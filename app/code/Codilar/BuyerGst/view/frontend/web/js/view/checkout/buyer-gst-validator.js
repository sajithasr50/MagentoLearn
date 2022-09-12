define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Codilar_BuyerGst/js/model/checkout/buyer-gst-validator'
    ],
    function (Component, additionalValidators, buyerGstValidator) {
        'use strict';

        additionalValidators.registerValidator(buyerGstValidator);

        return Component.extend({});
    }
);