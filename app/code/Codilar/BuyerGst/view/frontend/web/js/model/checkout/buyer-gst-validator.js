define(
    [
        'jquery',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/url',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Ui/js/model/messageList',
        'mage/translate'
    ],
    function ($, customer, quote, urlBuilder, urlFormatter, errorProcessor, messageContainer, __) {
        'use strict';

        return {

            /**
             * Make an ajax PUT request to store the purchase purpose in the quote.
             *
             * @returns {Boolean}
             */
            validate: function () {
                var isCustomer = customer.isLoggedIn();
                var form = this.getForm();

                var buyerGst = form.find('.input-text.buyer-gst').val();
                // if (this.hasMaxLength() && purpose.length > this.getMaxLength()) {
                //     messageContainer.addErrorMessage({ message: __("Comment is too long") });
                //     return false;
                // }
                var quoteId = quote.getQuoteId();
                var url;
                if (isCustomer) {
                    url = urlBuilder.createUrl('/carts/mine/set-buyer-gst', {})
                } else {
                    url = urlBuilder.createUrl('/guest-carts/:cartId/set-buyer-gst', {cartId: quoteId});
                }

                var payload = {
                    cartId: quoteId,
                    buyergst: {
                        buyerGst: buyerGst
                    }
                };

                if (!payload.buyergst.buyerGst) {
                    return true;
                }

                var result = true;

                $.ajax({
                    url: urlFormatter.build(url),
                    data: JSON.stringify(payload),
                    global: false,
                    contentType: 'application/json',
                    type: 'PUT',
                    async: false
                }).done(
                    function (response) {
                        result = true;
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );

                return result;
            },
            getForm: function () {
                var form =  $('.payment-method input[name="payment[method]"]:checked')
                    .parents('.payment-method')
                    .find('form.buyer-gst-form');

                // Compatibility for Rubic_CleanCheckout
                if (!form.length) {
                    form = $('form.buyer-gst-form');
                }
                
                return form;
            }
        };
    }
);
