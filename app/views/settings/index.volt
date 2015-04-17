<div id="main" role="main" class="flex-item-fluid pam ptn">
	<section class="w100">
		<div class="flex flex-v">
			{{ form("settings", "method":"post", "class": "formstd w100") }}
			    <h1 align="center">Modifier le profil</h1>
			    <h3 align="center">Mes informations</h3>
			    <label for="username" class="bold mas">Nom d'utilisateur</label>
			    {{ text_field("username", "size" : 30) }}
			    <br/>
			    <label for="date_creation" class="bold mas">Date de création du compte</label>
			    {{ text_field("date_creation", "disabled":"disabled") }}
			    <br/><br/>
			    <label for="password" class="bold mas">Mot de passe actuel</label>
			    {{ password_field("password", "size" : 30) }}
			    <br/>
			    <label for="newpassword" class="bold mas">Nouveau mot de passe</label>
			    {{ password_field("newpassword") }}
			    <br/>
			    <label for="confirmpassword" class="bold mas">Confirmer le nouveau mot de passe</label>
			    {{ password_field("confirmpassword") }}
			    <br/><br/>
			    <div class="txtcenter">
			    	{{ submit_button("OK", "class": "pure-button b-light-green white mas bold", "align": "center") }}
			    </div>
			{{ end_form() }}

			<div class="w100 mts">
			    <h3 align="center">Mes options</h3>
				{{ form("settings/parameter", "method":"post") }}
				    <label for="newsletter" class="bold mas">Recevoir la lettre d'informations</label>
				    <?php
				    	echo Phalcon\Tag::checkField(
				    		array_merge(
				    			array(
						    		"options[newsletter]",
						    		"value" => "1",
						    		"onclick" => "$(this).closest('form').submit();",
							    ),
						    	((isset($options->newsletter) && 1 == $options->newsletter) ? array("checked" => "") : array())
				    	)); ?>
				{{ end_form() }}
			    <br/>
			    <div class="txtcenter">
			    	{{ submit_button("OK", "hidden": "hidden") }}
			    </div>
			</div>
		</div>
	</section>
</div>