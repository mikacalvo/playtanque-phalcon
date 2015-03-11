
<article id="content" class="main flex flex-h">
	<nav class="w100p">
		{{ link_to("concours", '<i class="fa fa-2x fa-chevron-circle-left"></i>', "class":"pure-button b-light-blue white mas", "title":"Retour aux concours") }}
	</nav>
	{{ form("concours/create", "method":"post", "style": "width:100%") }}

		{{ content() }}

		<div align="center">
		    <h1>Nouveau concours</h1>
		    
		    <label for="label" class="bold mas">Label</label>
		    {{ text_field("label", "size" : 30) }}
		    <br/><br/>
		    <label for="date" class="bold mas">Date</label>
		    {{ date_field("date") }}
		    <br/><br/>
		    {{ submit_button("OK", "class": "pure-button b-light-green white mas bold") }}
		</div>

	{{ end_form() }}
</article>