<article id="content" class="main flex flex-h">
    <nav class="w100p">
        {{ link_to("joueur", '<i class="fa fa-2x fa-chevron-circle-left"></i>', "class":"pure-button b-light-blue white mas", "title":"Retour aux joueurs") }}
    </nav>
    {{ form("joueur/new", "method":"post", "style": "width:100%") }}

        {{ content() }}

        <div align="center">
            <h1>Nouveau joueur</h1>

            <label for="nom" class="bold mas">Nom</label>
            {{ text_field("nom", "size" : 30) }}
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
</article>