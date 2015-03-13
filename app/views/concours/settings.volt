
<article id="content" class="main flex flex-h txtcenter">
    <nav>
        {{ link_to("concours", '<i class="fa fa-chevron-circle-left"></i> Retour aux concours', "class":"pure-button b-light-blue white mas") }}
    </nav>
    <div class="wh100 pal">
        <h2>Paramétrage du concours</h2>
        <div class="w500p mcenter txtleft">
            <label class="w200p man h5-like">Type de concours</label>
            <i class="fa fa-2x fa-sitemap mash" title="Consolante" id="Consolante" data-div="consolante"></i>
            <i class="fa fa-2x fa-users mash" title="Mêlée" id="Melee" data-div="inter"></i>
            <i class="fa fa-2x fa-flag mash" title="Tournoi à points" id="Point" data-div="point"></i>
            <br/>
            <br/>
            <label class="w200p man h5-like">Type d'équipes</label>
            <i class="fa fa-2x fa-user mash" title="Simple" id="simple"></i>
            <i class="fa fa-2x fa-users mash" title="Doublette" id="doublette">x2</i>
            <i class="fa fa-2x fa-users mash" title="Triplette" id="triplette">x3</i>
        </div>
        <br/>
        <label class="h5-like" style="margin-right:10px">Joueurs / Équipes</label>
        {{ text_field("joueur1", "size" : 15) }}
        {{ text_field("joueur2", "size" : 15) }}
        {{ text_field("joueur3", "size" : 15) }}
        {{ submit_button("Ajouter", "class": "pure-button b-light-green white mas bold") }}
        <br/>
        <div id="teamlist">
        </div>
        {{ link_to("play/concours"~concours.id, '<i class="fa fa-rocket"></i> Démarrer le concours', "class":"pure-button b-red white mam") }}
    </div>
</article>