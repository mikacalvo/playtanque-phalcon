<!DOCTYPE html>
<html class="no-js scroll-v">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <?php echo $this->tag->getTitle(); ?>
	    <meta name="description" content="">
	    <meta name="viewport" content="width=device-width">
        <?php $this->assets->outputCss() ?>
        <link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Give You Glory' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php echo $this->getContent(); ?>
		
        <?php $this->assets->outputJs() ?>
        
        <?php $errors = $this->flashSession->getMessages('error'); $success = $this->flashSession->getMessages('success'); $warnings = $this->flashSession->getMessages('warning'); $notices = $this->flashSession->getMessages('notice'); ?>
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
				<?php foreach ($errors as $err) { ?>
			        var n = noty({
			        	text: '<?php echo $err; ?>',
			        	type: 'error'
			        });
				<?php } ?>
				<?php foreach ($success as $succ) { ?>
			        var n = noty({
			        	text: '<?php echo $succ; ?>',
			        	type: 'success'
			        });
				<?php } ?>
				<?php foreach ($warnings as $warning) { ?>
			        var n = noty({
			        	text: '<?php echo $warning; ?>',
			        	type: 'warning'
			        });
				<?php } ?>
				<?php foreach ($notices as $notice) { ?>
			        var n = noty({
			        	text: '<?php echo $notice; ?>',
			        	type: 'information'
			        });
				<?php } ?>
			    return false;
		    });
	    </script>
	</body>
</html>