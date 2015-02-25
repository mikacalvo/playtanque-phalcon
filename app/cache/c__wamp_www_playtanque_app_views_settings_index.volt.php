
<article id="content" class="main flex flex-h">
	<nav class="w200p">
		<?php echo $this->tag->linkTo(array('concours', '<i class="fa fa-chevron-circle-left"></i> Retour aux concours', 'class' => 'pure-button b-light-blue white mas')); ?>
		<br/>
		<?php echo $this->tag->linkTo(array('settings/club', 'Gérer mes clubs <i class="fa fa-chevron-circle-right"></i>', 'class' => 'pure-button b-red white mas bold')); ?>
	</nav>
	<section class="w100">
		<div class="flex flex-v">
			<?php echo $this->tag->form(array('settings/save', 'method' => 'post', 'class' => 'formstd w100')); ?>
			    <h1 align="center">Modifier le profil</h1>
			    <h3 align="center">Mes informations</h3>
			    <?php echo $this->tag->hiddenField(array('id')); ?>
			    <label for="username" class="bold mas">Nom d'utilisateur</label>
			    <?php echo $this->tag->textField(array('username', 'size' => 30)); ?>
			    <br/>
			    <label for="date_creation" class="bold mas">Date de création du compte</label>
			    <?php echo $this->tag->textField(array('date_creation', 'disabled' => 'disabled')); ?>
			    <br/><br/>
			    <label for="password" class="bold mas">Mot de passe actuel</label>
			    <?php echo $this->tag->passwordField(array('password', 'size' => 30)); ?>
			    <br/>
			    <label for="newpassword" class="bold mas">Nouveau mot de passe</label>
			    <?php echo $this->tag->passwordField(array('newpassword')); ?>
			    <br/>
			    <label for="confirmpassword" class="bold mas">Confirmer le nouveau mot de passe</label>
			    <?php echo $this->tag->passwordField(array('confirmpassword')); ?>
			    <br/><br/>
			    <div class="txtcenter">
			    	<?php echo $this->tag->submitButton(array('OK', 'class' => 'pure-button b-light-green white mas bold', 'align' => 'center')); ?>
			    </div>
			<?php echo $this->tag->endForm(); ?>
			
			<div class="w100 mas">
			    <h3 align="center">Mes options</h3>
			    <?php echo $this->tag->hiddenField(array('id')); ?>
				<?php echo $this->tag->form(array('settings/parameter', 'method' => 'post', 'class' => 'formstd')); ?>
				    <label for="newsletter" class="bold mas">Recevoir la lettre d'informations</label>
				    <?php echo $this->tag->checkField(array('newsletter', 'onclick' => '$(this).closest(\'form\').submit();')); ?>
				<?php echo $this->tag->endForm(); ?>
			    <br/>
			    <div class="txtcenter">
			    	<?php echo $this->tag->submitButton(array('OK', 'hidden' => 'hidden')); ?>
			    </div>
			</div>
		</div>
	</section>
</article>