<div>
    {{ content() }}
</div>
<article class="main flex flex-h mcenter">
    <nav class="flex-start">
        {{ link_to("concours/edit/"~concours.id, '<i class="fa fa-2x fa-chevron-circle-left"></i>', "class":"pure-button b-red white mam", "title":"Retour aux paramètres") }}
    </nav>



    <nav class="flex-end">
        {{ link_to("concours/play"~concours.id, '<i class="fa fa-2x fa-magic mars"></i> Commencer le concours', "class": "pure-button b-light-blue white mam", "title":"Commencer le concours") }}
    </nav>
</article>