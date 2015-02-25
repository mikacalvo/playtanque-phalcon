
<article id="content" class="main flex flex-h">
	<nav class="w100p">
		<?php echo $this->tag->linkTo(array('concours', '<i class="fa fa-chevron-circle-left"></i> Retour', 'class' => 'pure-button b-light-blue white mas')); ?>
	</nav>
	<?php echo $this->tag->form(array('concours/save', 'method' => 'post', 'style' => 'width:100%')); ?>

		<?php echo $this->getContent(); ?>

		<div align="center">
		    <h1>Modifier le concours</h1>
		    <?php echo $this->tag->hiddenField(array('id')); ?>
		    <label for="label" class="bold mas">Label</label>
		    <?php echo $this->tag->textField(array('label', 'size' => 30)); ?>
		    <br/><br/>
		    <label for="date" class="bold mas">Date</label>
		    <?php echo $this->tag->dateField(array('date')); ?>
		    <br/><br/>
		    <?php echo $this->tag->submitButton(array('OK', 'class' => 'pure-button b-light-green white mas bold')); ?>
		</div>

	<?php echo $this->tag->endForm(); ?>
</article>