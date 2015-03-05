<article id="content" class="main flex flex-h wrap mesjoueurs">
  <div class="flex-start mas pas w200p">
    {{ link_to("joueur/new", "<i class='fa fa-plus-circle fa-5x'></i>", "class":"light-blue glow-hover w100", "title":"Ajouter un joueur") }}
  </div>
  {% for joueur in userJoueurs %}
    <div class="mas pas">
      <span class="masc nom">{{ joueur.joueur.nom }}</span>
      <span class="masc gray poste">({{ joueur.joueur.getPoste() }})</span>
      {{ link_to("joueur/edit/" ~ joueur.joueur.id, '<i class="fa fa-pencil"></i>', "class":"pure-button b-light-green border rounder smaller", "style":"margin-right:3px;", "title":"Modifier le joueur") }}
      {{ link_to("joueur/delete/" ~ joueur.joueur.id, '<i class="fa fa-trash"></i>', "class":"pure-button b-red border rounder smaller", "title":"Supprimer le joueur") }}
    </div>
  {% endfor %}
</article>
