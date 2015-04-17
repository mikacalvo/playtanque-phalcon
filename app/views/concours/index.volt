<div class="flex-item-fluid pam ptn">
    {{ link_to("concours/new", '<i class="fa fa-plus-circle" style="font-size:4.5em;"></i>', "class":"pure-button b-light-blue white white-hover shadow-hover mas mtn large-inbl medium-inbl tiny-visible", "title":"Ajouter un concours") }}
    {% for concours in userConcours %}
        <div class="mas mtn large-inbl medium-inbl">
            <div class="pas border round b-white b-shadow-hover hover-a mw150p" title="Voir le concours">
                {{ link_to("play/concours/" ~ concours.concours.id, concours.concours.label, "class":"h5-like", "style":"display:block;", "title":"Voir le concours") }}
                <div class="txtleft" style="line-height:26px">
                    <span class="smaller"><i class='fa fa-calendar'></i> {{ concours.concours.date }}</span>
                    {{ link_to("concours/delete/" ~ concours.concours.id, '<i class="fa fa-trash"></i>', "class":"fr pure-button b-red border rounder smaller", "title":"Supprimer le concours") }}
                    {{ link_to("concours/edit/" ~ concours.concours.id, '<i class="fa fa-pencil"></i>', "class":"fr pure-button b-light-green border rounder smaller", "style":"margin-right:3px;", "title":"Modifier le concours") }}
                </div>
            </div>
        </div>
    {% endfor  %}
</div>