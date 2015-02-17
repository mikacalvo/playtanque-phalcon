function Point($element)
{
  var equipes = [];
  var $el = $element;
  var $tour = 3;
  var $divA;
  var $divB;
  var $seuilEquipes = 0;
  var $seuilMatchs = 0;
  var $divScores;
  $ulT = $("#tireurs");
  $ulM = $("#milieux");
  $ulP = $("#pointeurs");
  $divScores = $("#scores");
  $scores = [];
  var self = this;

  $el.on('change', 'select.score', function()
  {
    if('1' === $("#typeInter").val()) {
	    $scores[$(this).data("equipe")]["P"][$(this).data("tour")] = $(this).val();

	    $adv = ($(this).hasClass("odd")) ? $(this).prev() : $(this).next();

	    $scores[$(this).data("equipe")]["C"][$(this).data("tour")] = $adv.val();

	    $scores[$adv.data("equipe")]["C"][$(this).data("tour")] = $(this).val();

	    $scores[$(this).data("equipe")]["G"][$(this).data("tour")] = ($(this).val() == 13 ? 1 : 0);
	    paintScores(true);
	}
  });

  $el.on('change', 'select#nbTours', function()
  {
    if('1' === $("#typeInter").val()) {
	    $tour = $(this).val();
	    $scores = [];
	    initScores(equipes);
	}
  });

  $el.on('click', '#repartition .genere', function()
  {
    if('1' === $("#typeInter").val()) {
	    setConcours();
	}
  });

  function paintScores(sort)
  {
    $datas = $divScores.find(".datas");
    $datas.html("");
    for (var key in $scores) {
      if ($scores.hasOwnProperty(key)) {
        P = eval($scores[key]["P"].join('+'));
        C = eval($scores[key]["C"].join('+'));
        G = eval($scores[key]["G"].join('+'));
        O = eval($scores[key]["O"].join('+'));
        $datas.append(
          '<tr>'+
            '<td>'+key+'</td>'+
            '<td>'+((P==0) ? '' : P)+'</td>'+
            '<td>'+((C==0) ? '' : C)+'</td>'+
            '<td>'+(((P-C)==0) ? '' : (P-C))+'</td>'+
            '<td>'+((G==0) ? '' : G)+'</td>'+
            '<td>'+(((P-C+G)==0) ? '' : (P-C+G))+'</td>'+
          '</tr>'
        )
      }
    }
    if (sort) {
        $("#classementIS").trigger("update");
        var sorting = $('#classementIS')[0].config.sortList;
        setTimeout(function () {
            $("#classementIS").trigger("sorton", [sorting]);
        }, 10);
    }
  }


  function setConcours()
  {
    matchs = getUniqueMatchs(equipes);
    paintMatchs(matchs);
  }

  function getUniqueMatchs(equipes) {
    console.log("getUniqueMatchs");
    var cumul       = [];
    var matchs      = [];
    var numeroMatch = 0;
    var advExist    = true;
    var seuilTour   = 0;
    var equipeIndex = 0;
    var test   = false;
    for (var i = 0; i < $tour; i++) {
      var tmpEquipes  = copyArray(equipes);
      matchs[i] = [];
      numeroMatch = 0;
      matchs[i][numeroMatch] = [];
      matchs[i][numeroMatch].push(tmpEquipes[0]);
      tmpEquipes.splice(0, 1);
      advExist = false;
      shuffle(tmpEquipes);
      equipeIndex = 0;
      while (tmpEquipes.length > 0) {
        if(typeof matchs[i][numeroMatch] == 'undefined') { // La première équipe peut être n'importe laquelle
          matchs[i][numeroMatch] = [];
          matchs[i][numeroMatch].push(tmpEquipes[equipeIndex]);
          tmpEquipes.splice(equipeIndex, 1);
          advExist = true;
        } else { // Pour la deuxième
          for (var k = 0; k <= i; k++) { // On regarde les tours d'avant et l'actuel
            if (
              typeof cumul[tmpEquipes[equipeIndex]] != 'undefined'
              && (cumul[tmpEquipes[equipeIndex]].indexOf(matchs[i][numeroMatch][0]) != -1)
            ) {
              advExist = true;
              break;
            }
          }
          if (advExist) {
            equipeIndex++;
            if (equipeIndex >= tmpEquipes.length) { // On n'a pas trouvé de combinaison
              return getUniqueMatchs(equipes);
            }
          }
        }
        if(false === advExist) {
          matchs[i][numeroMatch].push(tmpEquipes[equipeIndex]);
          if (typeof cumul[tmpEquipes[equipeIndex]] == 'undefined') {
            cumul[tmpEquipes[equipeIndex]] = [];
          }
          cumul[tmpEquipes[equipeIndex]].push(matchs[i][numeroMatch][0]);
          if (typeof cumul[matchs[i][numeroMatch][0]] == 'undefined') {
            cumul[matchs[i][numeroMatch][0]] = [];
          }
          cumul[matchs[i][numeroMatch][0]].push(matchs[i][numeroMatch][1]);
          numeroMatch++;
          tmpEquipes.splice(equipeIndex, 1);
          equipeIndex = 0;
        } else {
          advExist = false;
        }
      }
    }
    return matchs;
  }

  function paintMatchs(matchs) {
    $("#liste").html('');
    for (i = 0; i<matchs.length; i++) { // Chaque tour
      $("#liste").append('<strong>Partie N°'+(i+1)+'</strong><br/>');
      for (var j = 0; j < matchs[i].length; j++) { // Chaque match
        var temp = matchs[i][j].slice();
        for (var k = 0; k < 2; k++) { // Chaque équipe
          if(impaire(k)) {
            $("#liste").append('<select id="team-'+i+'-'+j+'-'+k+'" data-tour="'+i+'" data-equipe="'+temp[k]+'" class="inbl score 0-13 odd" />');
            $("#liste").append('<label for="team-'+i+'-'+j+'-'+k+'" class="odd">' + temp[k] + '</label>');
            $("#liste").append('<br/>');
          } else {
            $("#liste").append('<label for="team-'+i+'-'+j+'-'+k+'">' + temp[k] + '</label>');
            $("#liste").append('<select id="team-'+i+'-'+j+'-'+k+'" data-tour="'+i+'" data-equipe="'+temp[k]+'" class="inbl score 0-13" />');
          }
        }
      }
    }
    appendScoreList($("#liste"));
  }

  function initScores(joueurs) {
    for (var i = 0; i < joueurs.length; i++) {
      $scores[joueurs[i]] = [];
      $scores[joueurs[i]]["P"] = [];
      $scores[joueurs[i]]["C"] = [];
      $scores[joueurs[i]]["G"] = [];
      $scores[joueurs[i]]["O"] = [];
      for (var j = 0; j < $tour; j++) {
        $scores[joueurs[i]]["P"][j] =  0;
        $scores[joueurs[i]]["C"][j] =  0;
        $scores[joueurs[i]]["G"][j] =  0;
        $scores[joueurs[i]]["O"][j] =  0;
      }
    }
  }

  this.paint = function() {
    initScores(equipes);
    paintScores(false);
    paintMatchs([]);
  };

  this.add = function(joueur)
  {
  	equipes.push(joueur);
    self.paint();
  };

  this.remove = function(index)
  {
    equipes.splice(equipes.indexOf(index), 1);
    self.paint();
  };

  this.clear = function()
  {
    equipes = [];
    $scores = [];
    self.paint();
  };

  this.start = function(nbTeams)
  {
    self.clear();
    $("#tableauRepartition").hide();
    $("#typeInter").val('1');
    $("#inter").removeClass("melee");
    $("#inter").addClass("point");
    
    for (index = 0; index < nbTeams; ++index) {
      self.add(teams.name(index));
    }
    self.paint();
  };
}

var point = new Point($('#inter'));