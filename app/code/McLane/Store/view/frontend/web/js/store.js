/**
 * Read customer data to show welcome message.
 */
define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function(Component, customerData) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            var customer = customerData.get('customer');
            this.customer = ', ' + customer().fullname;
        }
    });
});
