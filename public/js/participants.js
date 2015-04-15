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
});