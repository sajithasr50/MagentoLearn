define(
    [
        'jquery',
        'uiComponent',
        'knockout'
    ],
    function ($, Component, ko) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Codilar_BuyerGst/checkout/buyer-gst-block'
            },
            initialize: function() {
                this._super();
                var self = this;
                this.buyerGst = ko.observable("");
            },
            getInitialCollapseState: function() {
                return window.checkoutConfig.purchasepurpose_initial_collapse_state;
            },
            isInitialStateOpened: function() {
                return this.getInitialCollapseState() === 1
            },
            getPurchaseOption:function(){
                return window.checkoutConfig.purchase_option;
            }
        });
    }
);