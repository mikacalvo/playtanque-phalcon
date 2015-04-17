<div class="pam ptn">
    {{ link_to("joueur/new", '<i class="fa fa-plus-circle" style="font-size:4.5em;"></i>', "class":"pure-button b-light-blue white white-hover shadow-hover large-inbl medium-inbl tiny-visible", "title":"Ajouter un joueur") }}
</div>
<div id="main" role="main" class="flex-item-fluid ptn">
    <table id="tableJoueurs" class="table" style="max-width:700px" summary="Scores des joueurs">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Poste</th>
                <th width="76px"></th>
            </tr>
        </thead>
        <tbody class="datas">
            {% for joueur in userJoueurs %}
                <tr>
                    <td>{{ joueur.joueur.prenom }}</td>
                    <td>{{ joueur.joueur.nom }}</td>
                    <td>{{ joueur.joueur.getPoste() }}</td>
                    <td>
                        <div>
                            {{ link_to("joueur/edit/" ~ joueur.joueur.id, '<i class="fa fa-pencil"></i>', "class":"pure-button b-light-green border rounder smaller", "title":"Modifier le joueur") }}
                            {{ link_to("joueur/delete/" ~ joueur.joueur.id, '<i class="fa fa-trash"></i>', "class":"pure-button b-red border rounder smaller", "title":"Supprimer le joueur") }}
                        </div>
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>