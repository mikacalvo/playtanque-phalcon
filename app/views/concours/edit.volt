<div>
    {{ content() }}
</div>
{{ form("concours/edit/"~id, "method":"post", "id": "formConcours", "class": "main flex flex-h mcenter") }}
    <nav class="flex-start">
        {{ link_to("concours", '<i class="fa fa-2x fa-chevron-circle-left"></i>', "class":"pure-button b-red white mam", "title":"Retour aux concours") }}
    </nav>

    <div class="txtcenter mam">
        <h1>Modifier le concours</h1>
        {{ hidden_field("id") }}
        <label for="label" class="bold mas">Label</label>
        {{ text_field("label", "size" : 30) }}
        <br/><br/>
        <label for="date" class="bold mas">Date</label>
        {{ date_field("date") }}
        <br/><br/>
        <div class="inbl txtleft">
            {{ radio_field('type', 'value':'consolante','id':'consolante', 'required':'required') }}
            <label for="consolante">Consolante</label>
            <br>
            {{ radio_field('type', 'value':'melee','id':'melee', 'required':'required') }}
            <label for="melee">Mêlée</label>
            <br>
            {{ radio_field('type', 'value':'point','id':'point', 'required':'required') }}
            <label for="point">Points</label>
        </div>
        <div class="inbl txtleft">
            {{ radio_field('equipe', 'value':'1','id':'1', 'required':'required') }}
            <label for="1">Simple</label>
            <br>
            {{ radio_field('equipe', 'value':'2','id':'2', 'required':'required') }}
            <label for="2">Doublette</label>
            <br>
            {{ radio_field('equipe', 'value':'3','id':'3', 'required':'required') }}
            <label for="3">Triplette</label>
        </div>
        <br/>
        {{ submit_button("Sauvegarder", "class": "pure-button b-light-green white mam bold") }}
    </div>

    <nav class="flex-end">
        {{ link_to("concours/participants/"~id, '<i class="fa fa-2x fa-users mars"></i> Participants', "id":"linkParticipants", "class": "pure-button b-light-blue white mam", "title":"Gérer les participants") }}
    </nav>
{{ end_form() }}