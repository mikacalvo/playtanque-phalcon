<!DOCTYPE html>
<html class="no-js scroll-v">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    {{ get_title() }}
	    <meta name="description" content="">
	    <meta name="viewport" content="width=device-width">
	    <link rel="icon" href="../../public/img/favicon.ico" />
        <?php $this->assets->outputCss() ?>
        <link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Give You Glory' rel='stylesheet' type='text/css'>
	</head>
	<body>
		{{ content() }}
		
        <?php $this->assets->outputJs() ?>
        
        {% set errors = flashSession.getMessages('error'), success = flashSession.getMessages('success'), warnings = flashSession.getMessages('warning'), notices = flashSession.getMessages('notice') %}
	    <script>
	        $( document ).ready(function() {
	        	$.noty.defaults = {
				    layout: 'topRight',
				    theme: 'relax',
				    type: 'alert',
				    text: '',
				    dismissQueue: true,
				    template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
				    animation: {
				        open: {height: 'toggle'},
				        close: {height: 'toggle'},
				        easing: 'swing',
				        speed: 500
				    },
				    timeout: 3000,
				    force: false,
				    modal: false,
				    maxVisible: 3,
				    killer: false,
				    closeWith: ['click'],
				    callback: {
				        onShow: function() {},
				        afterShow: function() {},
				        onClose: function() {},
				        afterClose: function() {},
				        onCloseClick: function() {},
				    },
				    buttons: false
				};
				{% for err in errors %}
			        var n = noty({
			        	text: '{{ err }}',
			        	type: 'error'
			        });
				{% endfor %}
				{% for succ in success %}
			        var n = noty({
			        	text: '{{ succ }}',
			        	type: 'success'
			        });
				{% endfor %}
				{% for warning in warnings %}
			        var n = noty({
			        	text: '{{ warning }}',
			        	type: 'warning'
			        });
				{% endfor %}
				{% for notice in notices %}
			        var n = noty({
			        	text: '{{ notice }}',
			        	type: 'information'
			        });
				{% endfor %}
			    return false;
		    });
	    </script>
	</body>
</html>