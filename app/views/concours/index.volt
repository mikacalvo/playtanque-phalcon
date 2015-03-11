<article id="content" class="main flex flex-h wrap mesconcours">
	<div class="flex-start mas pas w200p">
		{{ link_to("concours/new", "<i class='fa fa-plus-circle fa-5x'></i>", "class":"light-blue glow-hover w100", "title":"Ajouter un concours") }}
	</div>

	{% for concours in userConcours %}
		<div class="mas pas">
			<div class="pas border round b-white b-shadow-hover hover-a mw150p" title="Voir le concours">
				{{ link_to("play/concours/" ~ concours.concours.id, concours.concours.label, "class":"h5-like", "style":"display:block;", "title":"Voir le concours") }}
				<div class="txtleft" style="line-height:26px">
					<span class="smaller"><i class='fa fa-calendar'></i> {{ concours.concours.date }}</span>
					{{ link_to("concours/delete/" ~ concours.concours.id, '<i class="fa fa-trash"></i>', "class":"right pure-button b-red border rounder smaller", "title":"Supprimer le concours") }}
					{{ link_to("concours/edit/" ~ concours.concours.id, '<i class="fa fa-pencil"></i>', "class":"right pure-button b-light-green border rounder smaller", "style":"margin-right:3px;", "title":"Modifier le concours") }}
				</div>
			</div>
		</div>
	{% endfor  %}
</article>
