<div id="main" role="main" class="flex-item-fluid pam ptn">
    {{ form("joueur/new", "method":"post", "style": "width:100%") }}

        {{ content() }}

        <div align="center">
            <h1>Nouveau joueur</h1>

            <label for="nom" class="bold mas w100p">Nom</label>
            {{ text_field("nom", "size" : 20) }}
            <br/>
            <label for="nom" class="bold mas w100p">Prénom</label>
            {{ text_field("prenom", "size" : 20) }}
            <br/><br/>
            {{ select_static('poste', [
                '0' : 'Poste privilégié...',
                '1' : 'Pointeur',
                '2' : 'Milieu',
                '3' : 'Tireur'
            ]) }}
            <br/><br/>
            {{ submit_button("OK", "class": "pure-button b-light-green white mas bold") }}
        </div>

    {{ end_form() }}
</div>