/**
 * Default usage for Dropdowns and Tooltips.
 */
requirejs(['jquery', 'jquery.bootstrap'], function($, bootstrap) {
    // see: https://getbootstrap.com/docs/4.3/components/dropdowns/#via-javascript
    $('.dropdown-toggle').dropdown();

    // see: https://getbootstrap.com/docs/4.3/components/tooltips/#usage
    $('.tooltip').tooltip();
});
