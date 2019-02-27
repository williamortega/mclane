/**
 *
 */
define([
    'jquery',
    'Magento_Ui/js/modal/confirm'
], function ($, confirm) {
    'use strict';

    var abandonedCartAlert = function(options, node) {
        $(node).on('click', function(e) {
            e.preventDefault();

            confirm({
                title: options.title,
                content: options.content,
                actions: {
                    confirm: function() {
                        // TODO: Clear cart items by ajax
                        //location.href = $(node).attr('href');
                    },
                    cancel: function() { },
                    always: function() { }
                }
            });
        });
    };

    return abandonedCartAlert;
});
