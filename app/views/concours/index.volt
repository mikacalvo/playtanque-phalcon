<article id="content" class="main flex flex-h wrap mesconcours">
	<div class="flex-start mas pas w200p">
		{{ link_to("concours/new", "<i class='fa fa-plus-circle fa-5x'></i>", "class":"light-blue glow-hover w100", "title":"Ajouter un concours") }}
	</div>

	{% for concours in userConcours %}
		<div class="mas pas">
			<button onclick="location.href='play/concours/{{ concours.concours.id }}'" class="pure-button border round b-light-yellow b-shadow-hover hover-a mw150p" title="Voir le concours">
				<h3 class="h5-like">{{ concours.concours.label }}</h3>
				<div class="txtleft" style="line-height:26px">
					<span class="smaller"><i class='fa fa-calendar'></i> {{ concours.concours.date }}</span>
					{{ link_to("concours/delete/" ~ concours.concours.id, '<i class="fa fa-trash"></i>', "class":"right pure-button b-red border rounder smaller", "title":"Supprimer le concours") }}
					{{ link_to("concours/edit/" ~ concours.concours.id, '<i class="fa fa-pencil"></i>', "class":"right pure-button b-light-green border rounder smaller", "style":"margin-right:3px;", "title":"Modifier le concours") }}
				</div>
			</button>
		</div>
	{% endfor  %}
</article>
