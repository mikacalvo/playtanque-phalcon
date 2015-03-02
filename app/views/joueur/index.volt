<article id="content" class="main flex flex-h wrap">
  <div class="flex-start mas pas w200p">
    {{ link_to("joueur/new", "<i class='fa fa-plus-circle fa-5x'></i>", "class":"light-blue glow-hover w100", "title":"Ajouter un joueur") }}
  </div>

  <div class="mas pas">
    <table style="width:auto;">
      {% for joueur in userJoueurs %}
        <tr>
          <td class="w200p">{{ joueur.joueur.nom }}</td>
          <td>{{ joueur.joueur.getPoste() }}</td>
          <td>{{ link_to("joueur/edit/" ~ joueur.joueur.id, '<i class="fa fa-pencil"></i>', "class":"pure-button b-light-green border rounder smaller", "style":"margin-right:3px;", "title":"Modifier le joueur") }}</td>
          <td>{{ link_to("joueur/delete/" ~ joueur.joueur.id, '<i class="fa fa-trash"></i>', "class":"pure-button b-red border rounder smaller", "title":"Supprimer le joueur") }}</td>
        </tr>
      {% endfor  %}
    </table>
</article>
