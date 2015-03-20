// Consolante Collection/View
function Consolante($element)
{
  var collection = [];
  var tournoiA = [];
  var tournoiB = [];
  var $el = $element;
  var $tour = -1;
  var $tour0 = $("#tour0");
  var $divA = $("#tournoiA");
  var $divB = $("#tournoiB");
  var self = this;

  $el.on('change', 'select.score', function()
  {
    $adv = ($(this).parent().hasClass("odd")) ? $(this).parent().prev() : $(this).parent().next();
    var tour = $(this).parents(".tour").data("id");
    var tournoi = (0 != tour) ? $(this).parents(".tournoi").data("id") : null;
    tournoi = (tournoi ? tournoi : "A");
    if (13 == $(this).val()) {
      if (13 == $adv.find('select').val()) {
        $adv.find('select').val('0');
        console.log("elimine", tournoi, (tour+1), $adv.data("id"));
        elimine(tournoi, (tour+1), $adv.data("id"));
      }
      console.log("qualifie", tournoi, (tour+1), $(this).parent().data("id"));
      qualifie(tournoi, (tour+1), $(this).parent().data("id"));
      if (0 == tour) {
        qualifie("B", (tour+1), $adv.data("id"));
        elimine("B", (tour+1), $(this).parent().data("id"));
      }
    } else {
      elimine(tournoi, (tour+1), $(this).parent().data("id"));
      if ("A" == tournoi && 0 == tour) {
        elimine("B", tour+1, $adv.data("id"));
      }
    }
  });

  function qualifie(tournoi, tour, team) {
    currentTournoi = ("A" == tournoi) ? tournoiA : tournoiB;
    console.log('add('+tournoi+','+tour+','+team+')');
    self.add(currentTournoi, tour, team);
    elimine(currentTournoi, tour+1, team);
  }

  function elimine(tournoi, tour, team) {
    currentTournoi = ("A" == tournoi) ? tournoiA : tournoiB;
    for (var i = tour; len = currentTournoi.length; i < len; i++) {
      if(currentTournoi[i].length>0) {
        console.log('remove('+tournoi+','+i+','+team+')');
        self.remove(currentTournoi, i, team);
      } else {
        break;
      }
    }
  }

  function paint(tournoi, tour)
  {
    console.log("paint", tournoi, tour);
    if (0 === tour) {
      $tour = $('.tour[data-id="'+tour+'"]');
      list = collection;
    } else if ("A" === tournoi) {
      $tour = $('#tournoiA .tour[data-id="'+tour+'"]');
      list = tournoiA;
    } else if ("B" === tournoi) {
      $tour = $('#tournoiB .tour[data-id="'+tour+'"]');
      list = tournoiB;
    }
    $tour.html('');
    for (var i = 0, len = list[tour].length; i<len; i++) {
      idTeam = list[tour][i];
      $tour.append(paintMatch(tour, idTeam, impaire(i)));
    }
    appendScoreList($tour);
  }

  function paintMatch(tour, idTeam, impaire) {
    return '<div class="match' + (impaire?' odd':'') + '" data-id="' + idTeam + '">' +
        '<label for="team'+idTeam+'-'+tour+'" class="inbl">' + teams.name(idTeam) + '</label>' +
        '<select id="team'+idTeam+'-'+tour+'" data-odd="' + (impaire?'true':'false') + '" class="inbl score 0-13" />' +
      '</div>';
  }

  function tours(nbTeams)
  {
    collection[0] = [];
    $tour0.html('');
    $divA.html('');
    $divB.html('');
    console.log('début tournoi avec '+nbTeams+' équipes');
    nbTours = Math.floor(nbTeams/2)-1;
    for (var i = 1; i<nbTours; i++) {
      console.log('initialisation du tour '+i+' > OK');
      collection[i] = [];
      tournoiA[i]   = [];
      tournoiB[i]   = [];
      $divA.append(
        '<div class="tour w200p pam scroll-v" data-id="' + i + '" style="background:' + colorTour(i, 120) + ';"></div>'
      );
      $divB.append(
        '<div class="tour w200p pam scroll-v" data-id="' + i + '" style="background:' + colorTour(i, 0) + ';"></div>'
      );
    }
  }

  function colorTour(index, teinte)
  {
    return "hsl("+teinte+","+(30+index*4)+"%,"+(70-index*(100/teams.length()))+"%)";
  }

  this.add = function(tournoi, tour, team)
  {
    tournoi[tour].push(team);
    $currentDiv = (tournoi == tournoiA) ? $('#tournoiA .tour[data-id="'+tour+'"]') : $('#tournoiB .tour[data-id="'+tour+'"]');
    $currentDiv.append(paintMatch(tour, team, impaire(tournoi[tour].length-1)));
    appendScoreList($currentDiv);
    // paint(tour);
  };

  this.remove = function(tournoi, tour, team)
  {
    tournoi[tour].removeVal(team);
    paint((tournoi == tournoiA ? "A" : "B"), tour);
  };

  this.clear = function()
  {
    collection = [];
    $tour0.html('');
    $divA.html('');
    $divB.html('');
  };

  this.start = function(nbTeams)
  {
    // créer un nombre de tour en fonction du nombre d'équipes
    tours(nbTeams);
    // mettre en place le premier tour
    for (index = 0; index < nbTeams; ++index) {
      collection[0].push(index);
    }
    shuffle(collection[0]);
    paint("", 0);
    console.log(collection);
  };
}

var consolante = new Consolante($('#consolante'));
