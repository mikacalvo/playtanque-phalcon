$(document).ready(function(){
    $(".ui-autocomplete-input").autocomplete({
        minLength: 0,
        source: availableJoueurs,
        // focus: function( event, ui ) {
        //     $(this).val(ui.item.label);
        //     return false;
        // },
        select: function( event, ui ) {
            $(this).val(ui.item.label);
            $("#" + $(this).data('input')).val(ui.item.value);
            if ($(this).data('poste')) {
                $("#poste").val(ui.item.poste);
            }
            return false;
        }
    }).focus(function(){
        $(this).trigger('keydown');
    }).keyup(function(e) {
        var code = e.keyCode || e.which;
        if (code != 13 && code != 9) {
            $("#" + $(this).data('input')).val($(this).val());
        }
    });


    var oldList, newList, item;
    $( "#tireurs, #milieux, #pointeurs" ).sortable({
        placeholder: "highlight",
        forcePlaceholderSize: true,
        start: function(event, ui) {
            item = ui.item;
            newList = oldList = ui.item.parent();
            oldIndex = ui.item.index();
        },
        stop: function(event, ui) {
            console.log({ equipe_id: newList.data("equipe"), joueur_id: ui.item.data("joueur"), poste: newList.data("poste") });
            if (newList != oldList) {
                $.ajax({
                    url: "/concours/moveJoueur",
                    method: "post",
                    context: document.body,
                    data: { equipe_id: newList.data("equipe"), joueur_id: ui.item.data("joueur"), poste: newList.data("poste") }
                }).done(function() {
                    $( this ).addClass( "done" );
                });
            }
        },
        change: function(event, ui) {
            if(ui.sender) newList = ui.placeholder.parent();
        },
        helper: 'clone',
        connectWith: '.sortable',
        distance: 5,
    });
});