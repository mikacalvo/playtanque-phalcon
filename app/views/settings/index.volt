
<article id="content" class="main flex flex-h">
	<nav class="w200p">
		{{ link_to("concours", '<i class="fa fa-2x fa-chevron-circle-left"></i>', "class":"pure-button b-light-blue white mas", "title":"Retour aux concours") }}
		<br/>
		{{link_to("settings/club", 'Gérer mes clubs <i class="fa fa-chevron-circle-right"></i>', "class": "pure-button b-red white mas bold")}}
	</nav>
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
			
			<div class="w100 mas">
			    <h3 align="center">Mes options</h3>
				{{ form("settings/parameter", "method":"post") }}
			    	{{ hidden_field("id") }}
				    <label for="newsletter" class="bold mas">Recevoir la lettre d'informations</label>
				    {{ check_field("newsletter", "onclick": "$(this).closest('form').submit();") }}
				{{ end_form() }}
			    <br/>
			    <div class="txtcenter">
			    	{{ submit_button("OK", "hidden": "hidden") }}
			    </div>
			</div>
		</div>
	</section>
</article>