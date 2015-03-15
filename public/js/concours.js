
function appendScoreList(element) {
  var $select = element.find(".0-13:not(.ok)");
  for (i=0;i<=13;i++){
    $select.append($('<option></option>').val(i).html((0==i?'-':i)));
  }
  $select.addClass("ok");
  // $select.after('<input type="text" class="on-print w25p masc" val=""/>')
};

$(document).ready(function() {
  $("#classementIS").tablesorter(
    {
      sortList: [[5,1]]
    }
  );
});


$('.navspan').on('click', function(event) {
  if(!$(this).hasClass("active")) {
    $('.navspan').removeClass('active');
    $(this).addClass("active");
  }
  $('#startConcours').trigger("click");
});

$('#startConcours').on('click', function (event) {
  var Temp = function(){};
  var Type = $(".navspan.active").attr("id");
  var div = $(".navspan.active").data("div");
  if(!Type) {
    alert('Veuillez choisir un type de concours.');
  } else {
    $(".concours").hide();
    $('#'+div).show();
    try {
      concours = window[Type.charAt(0).toLowerCase() + Type.slice(1)];
      concours.clear();
      concours.start(teams.length());
    }
    catch(err) {
      console.log(err);
    }
  }
});

$('#hide').on('click', function (event) {
  $('.application').addClass("reduced");
});

$('#show').on('click', function (event) {
  $('.application').removeClass("reduced");
});

$('#genereTeams').on('click', function (event) {
  teams.add('Capo');
  teams.add('Arigucci');
  teams.add('Titi');
  teams.add('Caldari');
  teams.add('José');
  teams.add('JP');

  teams.add('Jacky');
  teams.add('Patrick');
  teams.add('Sbicca');
  teams.add('Bruno');
  teams.add('Richard');
  teams.add('Christian');

  teams.add('Mika');
  teams.add('Pitcha');
  teams.add('Anthony');
  teams.add('Lola');
  teams.add('Jean-Marc');
  teams.add('Roger');

  teams.add('Patricia');
  teams.add('Nicolas');
  teams.add('Cédric');
  teams.add('Toussaint');
  teams.add('Gilles');
  teams.add('Marvin');

  teams.add('bisCapo');teams.add('terCapo');teams.add('quatreCapo');
  teams.add('bisArigucci');teams.add('terArigucci');teams.add('quatreArigucci');
  teams.add('bisTiti');teams.add('terTiti');teams.add('quatreTiti');
  teams.add('bisCaldari');teams.add('terCaldari');teams.add('quatreCaldari');
  teams.add('bisJosé');teams.add('terJosé');teams.add('quatreJosé');
  teams.add('bisJP');teams.add('terJP');teams.add('quatreJP');

  teams.add('bisJacky');teams.add('terJacky');teams.add('quatreJacky');
  teams.add('bisPatrick');teams.add('terPatrick');teams.add('quatrePatrick');
  teams.add('bisSbicca');teams.add('terSbicca');teams.add('quatreSbicca');
  teams.add('bisBruno');teams.add('terBruno');teams.add('quatreBruno');
  teams.add('bisRichard');teams.add('terRichard');teams.add('quatreRichard');
  teams.add('bisChristian');teams.add('terChristian');teams.add('quatreChristian');

  teams.add('bisMika');teams.add('terMika');teams.add('quatreMika');
  teams.add('bisPitcha');teams.add('terPitcha');teams.add('quatrePitcha');
  teams.add('bisAnthony');teams.add('terAnthony');teams.add('quatreAnthony');
  teams.add('bisLola');teams.add('terLola');teams.add('quatreLola');
  teams.add('bisJean-Marc');teams.add('terJean-Marc');teams.add('quatreJean-Marc');
  teams.add('bisRoger');teams.add('terRoger');teams.add('quatreRoger');

  teams.add('bisPatricia');teams.add('terPatricia');teams.add('quatrePatricia');
  teams.add('bisNicolas');teams.add('terNicolas');teams.add('quatreNicolas');
  teams.add('bisCédric');teams.add('terCédric');teams.add('quatreCédric');
  teams.add('bisToussaint');teams.add('terToussaint');teams.add('quatreToussaint');
  teams.add('bisGilles');teams.add('terGilles');teams.add('quatreGilles');
  teams.add('bisMarvin');teams.add('terMarvin');teams.add('quatreMarvin');
  if(!$('#Inter').hasClass('active')) {
    $('#Inter').click();
  }
});

$(function() {
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
        var newIndex = ui.item.index();
        console.log("Moved " + item.find("span:last").text() + " from " + oldList.attr('id')+"/"+oldIndex + " to " + newList.attr('id')+"/"+ui.item.index());
        if (newList != oldList) {
          concours.add(newList.attr("id"), ui.item.index(), item.find("span:last").text());
          concours.remove(oldList.attr("id"), oldIndex);
        } else {
          concours.move(oldList.attr("id"), oldIndex, newIndex);
        }
        concours.paint();
      },
      change: function(event, ui) {
        if(ui.sender) newList = ui.placeholder.parent();
      },
      helper: 'clone',
      connectWith: '.sortable',
      distance: 5,
    });
});