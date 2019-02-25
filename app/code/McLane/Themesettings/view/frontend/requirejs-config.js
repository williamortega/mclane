/**
 * Bootstrap JS configuration.
 */

var config = {
    deps: [
        'McLane_Themesettings/js/init'
    ],
    paths: {
        'jquery.bootstrap': 'McLane_Themesettings/js/bootstrap.bundle.min'
    },
    shim: {
        'jquery.bootstrap': {
            'deps': ['jquery']
        }
    }
};
