define([
    'jquery',
    'mage/url'
    ], function ($,url) {
        'use strict';
        $.widget('codilar.buyergstorder', {
            options: {
                ajaxurl: 'admin/buyergst/buyergst/index',
                order: 0
            },
            _create: function() {
                var self = this;
                $(document).on("click","#buyer-gst-btn", function(event) {
                    event.preventDefault();
                    self._ajaxSubmit();
                    return false;
                });
                //this._ajaxSubmit();
            },
            _ajaxSubmit: function() {
             $.ajax({
                url: this.options.ajaxurl,
                type: "POST",
                data: {
                    form_key: window.FORM_KEY,
                    order: this.options.order,
                    buyergst: $("#buyergst-101").val()
                },
                showLoader: true,
            }).done(function (data) {
                    return true;
                });
            }
        });
    return $.codilar.buyergstorder;
});