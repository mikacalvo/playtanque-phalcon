<div>
    {{ content() }}
</div>
<article class="main flex flex-h mcenter">
    <nav class="flex-start">
        {{ link_to("concours/edit/"~concours.id, '<i class="fa fa-2x fa-chevron-circle-left"></i>', "class":"pure-button b-red white mam", "title":"Retour aux paramètres") }}
    </nav>

    <div class="txtcenter mam">
        <h1>Participants</h1>
        <p class="info"><em>pour un concours de type <strong>{{ concours.options.type }}</strong> et des équipes de <strong>{{ concours.options.equipe }}</strong> joueurs</em></p>
        {{ hidden_field("id") }}
        {% if concours.options.type == 'consolante' %}
            {{ form("concours/addEquipe", "method":"post", "id": "addEquipe") }}
                {{ hidden_field("tailleEquipe") }}
                {{ hidden_field("id") }}
                <input type="text" class="sharp inbl inboxshadow b-white pas par ui-autocomplete-input" data-input="equipeJoueur1" placeholder="Joueur 1" required="required" autocomplete="off"/>
                <input type="hidden" id="equipeJoueur1" name="joueur1">
                {% if concours.options.equipe >= 2 %}
                    <input type="text" class="sharp inbl inboxshadow b-white pas par ui-autocomplete-input" data-input="equipeJoueur2" placeholder="Joueur 2" required="required" autocomplete="off"/>
                    <input type="hidden" id="equipeJoueur2" name="joueur2">
                {% endif %}
                {% if concours.options.equipe == 3 %}
                    <input type="text" class="sharp inbl inboxshadow b-white pas par ui-autocomplete-input" data-input="equipeJoueur3" placeholder="Joueur 3" required="required" autocomplete="off"/>
                    <input type="hidden" id="equipeJoueur3" name="joueur3">
                {% endif %}
                <br/>
                {{ submit_button("Ajouter", "class": "pure-button b-light-blue white bold", "style": "margin-left:120px") }}
                <em style="margin-left:20px;">({{ nbEquipes }} {% if nbEquipes <=1 %}équipe ajoutée{% else %}équipes ajoutées{% endif %})</em>
            {{ end_form() }}
        {% endif %}

        <table id="participantsConcours" class="striped tablesorter mas" summary="Scores des joueurs" style="table-layout:auto;">
            <tbody class="datas">

                {% if concours.options.type == 'consolante' %}
                    {% for equipe in equipes %}
                        <tr>
                            {% for equipeJoueur in equipe.equipesJoueurs %}
                                <td class="w33">
                                    <label class="man editable">{{ equipeJoueur.joueur.prenom }} {{ equipeJoueur.joueur.nom }}</label>
                                    <input type="text" class="dark editable" value="{{ equipeJoueur.joueur.id }}"/>
                                </td>
                            {% endfor %}
                            {% if equipe.data is defined %}
                                {% for joueur in equipe.data %}
                                    <td class="w33">
                                        <label class="man editable">{{ joueur }}</label>
                                        <input type="text" class="dark editable" value="{{ joueur }}"/>
                                    </td>
                                {% endfor %}
                            {% endif %}
                            <td style="width:46px;">
                                {{ form("concours/deleteEquipe", "method":"post") }}
                                    {{ hidden_field("id") }}
                                    <input type="hidden" name="equipe_id" value="{{ equipe.id }}">
                                    <button type="submit" class="pure-button b-red border rounder smaller deleteEquipe">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                {{ end_form() }}
                            </td>
                        </tr>
                    {% endfor %}
                {% endif %}

                {% if concours.options.type == 'melee' %}
                    {{ form("concours/addEquipe", "method":"post", "id": "addEquipe") }}
                        {{ hidden_field("id") }}
                        <input type="text" class="sharp inbl inboxshadow b-white pas par ui-autocomplete-input" data-input="joueur" data-poste="1" placeholder="Joueur" required="required" autocomplete="off"/>
                        <input type="hidden" id="joueur" name="joueur">
                        {{ select_static('poste', [
                            '0' : 'Poste...',
                            '1' : 'Pointeur',
                            '2' : 'Milieu',
                            '3' : 'Tireur'
                        ], "class" : "mas") }}
                        {{ submit_button("Ajouter", "class": "pure-button b-light-blue white bold", "style": "margin-left:120px") }}
                        <em style="margin-left:20px;">({{ nbEquipes }} {% if nbEquipes <=1 %}joueur ajouté{% else %}joueurs ajoutés{% endif %})</em>
                    {{ end_form() }}
                    <br/>
                    <table id="tableauRepartition" class="striped" summary="Répartition des joueurs">
                        <thead>
                            <tr>
                                <th scope="col" class="txtcenter">Tireurs</th>
                                <th scope="col" class="txtcenter">Milieux</th>
                                <th scope="col" class="txtcenter">Pointeurs</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <ul id="tireurs" class="sortable unstyled man inbl">
                                    </ul>
                                </td>
                                <td>
                                    <ul id="milieux" class="sortable unstyled man inbl">
                                    </ul>
                                </td>
                                <td>
                                    <ul id="pointeurs" class="sortable unstyled man inbl">
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                {% endif %}
            </tbody>
        </table>


    </div>

    <nav class="flex-end">
        {{ link_to("concours/play"~concours.id, '<i class="fa fa-2x fa-magic mars"></i> Commencer le concours', "class": "pure-button b-light-blue white mam", "title":"Commencer le concours") }}
    </nav>
</article>
<style>
  .ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
  }
  * html .ui-autocomplete {
    height: 100px;
  }
</style>
<script>
    var availableJoueurs = [
        {% for availableJoueur in availableJoueurs %}
            {% set options = availableJoueur.options|json_decode %}
            {value: {{availableJoueur.id}}, label: '{{availableJoueur.prenom}} {{availableJoueur.nom}}', poste: '{{options.poste}}'}
            {% if !loop.last %},{% endif %}
        {% endfor %}
    ];
</script>