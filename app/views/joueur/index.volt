<article id="content" class="main flex flex-h wrap mesjoueurs">
	<div class="flex-start mam">
		{{ link_to("joueur/new", '<i class="fa fa-2x fa-plus-circle"></i>', "class":"pure-button b-light-blue white", "title":"Ajouter un concours") }}
	</div>

	<table id="classementIS" class="striped tablesorter" summary="Scores des joueurs" style="table-layout:auto;">
		<thead>
			<tr>
				<th scope="col" class="txtcenter" style="width: 5%"></th>
				<th scope="col" class="txtcenter" style="width: 20%">Prénom</th>
				<th scope="col" class="txtcenter" style="width: 20%">Nom</th>
				<th scope="col" class="txtcenter" style="width: 10%">Poste</th>
			</tr>
		</thead>
		<tbody class="datas">
			{% for joueur in userJoueurs %}
				<tr>
					<td>
						{{ link_to("joueur/delete/" ~ joueur.joueur.id, '<i class="fa fa-trash"></i>', "class":"pure-button b-red border rounder smaller", "title":"Supprimer le joueur") }}
						{{ link_to("joueur/edit/" ~ joueur.joueur.id, '<i class="fa fa-pencil"></i>', "class":"pure-button b-light-green border rounder smaller", "style":"margin-right:3px;", "title":"Modifier le joueur") }}
					</td>
					<td>{{ joueur.joueur.prenom }}</td>
					<td>{{ joueur.joueur.nom }}</td>
					<td>{{ joueur.joueur.getPoste() }}</td>
				</tr>
			{% endfor %}
		</tbody>
	</table>
</article>
