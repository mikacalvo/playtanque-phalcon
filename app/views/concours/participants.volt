{{ form("concours/participants/"~concours.id, "method":"post", "id": "formParticipants", "class": "main flex flex-h mcenter") }}
    <nav class="flex-start">
        {{ link_to("concours/edit/"~concours.id, '<i class="fa fa-2x fa-chevron-circle-left"></i>', "class":"pure-button b-red white mam", "title":"Retour aux paramètres") }}
    </nav>

    {{ content() }}

    <div class="txtcenter mam">
        <h1>Participants</h1>
        {{ hidden_field("id") }}
        {% if concours.options.type == 'consolante' %}
            <input type="text" id="equipeJoueur1" name="joueur1" class="sharp inbl inboxshadow b-white pas par" placeholder="Joueur 1" />
            {% if concours.options.equipe >= 2 %}
                <input type="text" id="equipeJoueur2" name="joueur2" class="sharp inbl inboxshadow b-white pas par" placeholder="Joueur 2" />
            {% endif %}
            {% if concours.options.equipe == 3 %}
                <input type="text" id="equipeJoueur3" name="joueur3" class="sharp inbl inboxshadow b-white pas par" placeholder="Joueur 3" />
            {% endif %}
        {% endif %}

        {{ submit_button("Ajouter", "class": "pure-button b-light-blue white mals bold") }}

        <table id="classementIS" class="striped tablesorter mas" summary="Scores des joueurs" style="table-layout:auto;">
            <tbody class="datas">

                {% if concours.options.type == 'consolante' %}
                    {% for joueur in concoursJoueurs %}
                        <td>
                            {{ link_to("concours/deleteJoueur/" ~ joueur.joueur.id, '<i class="fa fa-trash"></i>', "class":"pure-button b-red border rounder smaller", "title":"Supprimer le joueur") }}
                        </td>
                    {% endfor %}
                {% endif %}

                {% if concours.options.type == 'melee' %}
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
{{ end_form() }}