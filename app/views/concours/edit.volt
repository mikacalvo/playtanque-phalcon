<div id="main" role="main" class="flex-item-fluid pam ptn">
    <h1 class="txtcenter">Modifier le concours</h1>
    {{ form("concours/edit/"~id, "method":"post", "id": "formConcours", "class": "w400p center") }}
        {{ hidden_field("id") }}
        <label for="label" class="bold mas w100p">Label</label>
        {{ text_field("label", "size" : 30) }}
        <br/>
        <label for="date" class="bold mas w100p">Date</label>
        {{ date_field("date") }}
        <br/>
        <div class="inbl mas mtn txtleft">
            {{ radio_field('type', 'value':'consolante','id':'consolante', 'required':'required') }}
            <label for="consolante">Consolante</label>
            <br>
            {{ radio_field('type', 'value':'melee','id':'melee', 'required':'required') }}
            <label for="melee">Mêlée</label>
            <br>
            {{ radio_field('type', 'value':'point','id':'point', 'required':'required') }}
            <label for="point">Points</label>
        </div>
        <div class="inbl mas mtn txtleft">
            {{ radio_field('equipe', 'value':'1','id':'1', 'required':'required') }}
            <label for="1">Simple</label>
            <br>
            {{ radio_field('equipe', 'value':'2','id':'2', 'required':'required') }}
            <label for="2">Doublette</label>
            <br>
            {{ radio_field('equipe', 'value':'3','id':'3', 'required':'required') }}
            <label for="3">Triplette</label>
        </div>
        {{ submit_button("Sauvegarder", "class": "pure-button b-light-green white mam mtl bold") }}
    {{ end_form() }}
</div>
<div id="participants" class="txtcenter w100">
    <p class="info"><em>Participants pour un concours de type <strong>{{ concours.options.type }}</strong> et des équipes de <strong>{{ concours.options.equipe }}</strong> joueurs</em></p>
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
    <br>
    <table id="participantsConcours" class="striped tablesorter" summary="Scores des joueurs" style="table-layout:auto;">
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
                            <th scope="col" class="txtcenter">Pointeurs</th>
                            <th scope="col" class="txtcenter">Milieux</th>
                            <th scope="col" class="txtcenter">Tireurs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul id="pointeurs" data-poste="1" data-equipe="{{ equipes.id }}" class="sortable unstyled man inbl">
                                    {% for equipeJoueur in equipes.equipesJoueurs %}
                                        {% if equipeJoueur.poste==1 %}
                                            <li data-joueur="{{ equipeJoueur.joueur.id }}">{{ equipeJoueur.joueur.prenom }} {{ equipeJoueur.joueur.nom }}</li>
                                        {% endif %}
                                    {% endfor %}
                                </ul>
                            </td>
                            <td>
                                <ul id="milieux" data-poste="2" data-equipe="{{ equipes.id }}" class="sortable unstyled man inbl">
                                    {% for equipeJoueur in equipes.equipesJoueurs %}
                                        {% if equipeJoueur.poste==2 %}
                                            <li data-joueur="{{ equipeJoueur.joueur.id }}">{{ equipeJoueur.joueur.prenom }} {{ equipeJoueur.joueur.nom }}</li>
                                        {% endif %}
                                    {% endfor %}
                                </ul>
                            </td>
                            <td>
                                <ul id="tireurs" data-poste="3" data-equipe="{{ equipes.id }}" class="sortable unstyled man inbl">
                                    {% for equipeJoueur in equipes.equipesJoueurs %}
                                        {% if equipeJoueur.poste==3 %}
                                            <li data-joueur="{{ equipeJoueur.joueur.id }}">{{ equipeJoueur.joueur.prenom }} {{ equipeJoueur.joueur.nom }}</li>
                                        {% endif %}
                                    {% endfor %}
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            {% endif %}
        </tbody>
    </table>

    <script>
        var availableJoueurs = [
            {% for availableJoueur in availableJoueurs %}
                {% set options = availableJoueur.options|json_decode %}
                {value: {{availableJoueur.id}}, label: '{{availableJoueur.prenom}} {{availableJoueur.nom}}', poste: '{{options.poste}}'}
                {% if !loop.last %},{% endif %}
            {% endfor %}
        ];
    </script>
</div>