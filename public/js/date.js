yepnope({ /* included with Modernizr */
    test : Modernizr.inputtypes.date,
    nope : {
        'css': '/js/vendor/jquery-ui-1.11.2.custom/jquery-ui.min.css',
        'js': '/js/vendor/jquery-ui-1.11.2.custom/jquery-ui.min.js'
    },
    callback: { // executed once files are loaded
        'js': function() { $('input[type=date]').datepicker({dateFormat: "yy-mm-dd"}); } // default HTML5 format
    }
});