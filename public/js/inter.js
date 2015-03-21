function Inter($element)
{
  var tireurs    = [];
  var milieux    = [];
  var pointeurs  = [];
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
    if('0' === $("#typeInter").val()) {
        $scores[$(this).data("tireur")]["P"][$(this).data("tour")] = $(this).val();
        $scores[$(this).data("milieu")]["P"][$(this).data("tour")] = $(this).val();
        $scores[$(this).data("pointeur")]["P"][$(this).data("tour")] = $(this).val();

        $adv = ($(this).hasClass("odd")) ? $(this).prev() : $(this).next();

        $scores[$(this).data("tireur")]["C"][$(this).data("tour")] = $adv.val();
        $scores[$(this).data("milieu")]["C"][$(this).data("tour")] = $adv.val();
        $scores[$(this).data("pointeur")]["C"][$(this).data("tour")] = $adv.val();

        $scores[$adv.data("tireur")]["C"][$(this).data("tour")] = $(this).val();
        $scores[$adv.data("milieu")]["C"][$(this).data("tour")] = $(this).val();
        $scores[$adv.data("pointeur")]["C"][$(this).data("tour")] = $(this).val();

        $scores[$(this).data("tireur")]["G"][$(this).data("tour")] = ($(this).val() == 13 ? 1 : 0);
        $scores[$(this).data("milieu")]["G"][$(this).data("tour")] = ($(this).val() == 13 ? 1 : 0);
        $scores[$(this).data("pointeur")]["G"][$(this).data("tour")] = ($(this).val() == 13 ? 1 : 0);
        paintScores(true);
    }
  });

  $el.on('change', 'select#nbTours', function()
  {
    if('0' === $("#typeInter").val()) {
        $tour = $(this).val();
        $scores = [];
        initScores(tireurs);
        initScores(milieux);
        initScores(pointeurs);
    }
  });

  $el.on('click', '#repartition .genere', function()
  {
    if('0' === $("#typeInter").val()) {
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
            '<td>'+P+'</td>'+
            '<td>'+C+'</td>'+
            '<td>'+(P-C)+'</td>'+
            '<td>'+G+'</td>'+
            '<td>'+(P-C+G)+'</td>'+
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

  function paintRepartition()
  {
    $ulT.html('');
    $ulM.html('');
    $ulP.html('');
    for (var i = 0, len = tireurs.length; i<len; i++) {
        $ulT.append('<li><span style="background:hsl('+(320*i/len)+', 60%, 60%)">T'+(i+1)+'</span><span>'+tireurs[i]+'</span></li>');
    }
    for (var i = 0, len = milieux.length; i<len; i++) {
        $ulM.append('<li><span style="background:hsl('+(320*i/len)+', 60%, 60%)">M'+(i+1)+'</span><span>'+milieux[i]+'</span></li>');
    }
    for (var i = 0, len = pointeurs.length; i<len; i++) {
        $ulP.append('<li><span style="background:hsl('+(320*i/len)+', 60%, 60%)">P'+(i+1)+'</span><span>'+pointeurs[i]+'</span></li>');
    }
  }


  function setConcours()
  {
    if(!(tireurs.length == milieux.length && milieux.length == pointeurs.length)) return;

    $("#liste").html('Génération des combinaisons uniques en cours...');

    setTimeout(function(){
      var equipes = getUniqueTeams();
      if(matchs  = getUniqueMatchs(equipes)) {
        paintMatchs(matchs);
        $seuilMatchs = 0;
        $seuilEquipes = 0;
      } else {
        $seuilMatchs = 0;
        $seuilEquipes++;
        setConcours();
      }
    }, 1000);
  }

  function getUniqueTeams() {
    // Traitement aléatoire sans doublons
    console.log("getUniqueTeams", $seuilEquipes);
    var equipes = [];
    var cumul = [];
    var nbEquipes = tireurs.length;
    var comb = combinaisons();
    for (var j = 0; j < nbEquipes; j++) {
      cumul[tireurs[j]] = [];
      cumul[tireurs[j]]["partenaires"] = [];
    };
    for (var i = 0; i < $tour; i++) {
      equipes[i] = [];
      cumul[i]   = []; // joueurs déjà utilisés pour ce tour.
      shuffle(tireurs);
      for (var j = 0; j < nbEquipes; j++) {
        equipes[i][j] = [];
        equipes[i][j].push(tireurs[j]);
      };
      var combTest = comb.slice(); // on duplique
      for (var j = 0; j < nbEquipes; j++) { // pour chaque tireur
        if(0 === comb.length) {
          console.log("plus de combinaisons possibles, on recommence");
          $seuilEquipes++;
          return getUniqueTeams();
        }
        var combExist = true;
        while (combExist === true) { // on teste les combinaisons possibles
          combIndex = Math.floor((Math.random() * combTest.length));
          for (var l = 0; l < 2; l++) { // milieu et pointeur
            if(
              typeof combTest[combIndex] == 'undefined'
              || ( i < 3
                && (
                  cumul[tireurs[j]]["partenaires"].indexOf(combTest[combIndex][l]) != -1
                  || (typeof cumul[i] != 'undefined' && cumul[i].indexOf(combTest[combIndex][l]) != -1)
                )
              )
            ) {
              combExist = true;
              combTest.splice(combIndex, 1);
              if(0 === combTest.length) {
                console.log("plus de combinaisons possibles, on recommence");
                $seuilEquipes++;
                return getUniqueTeams();
              }
              break;
            } else {
              combExist = false;
            }
          }
        }
        equipes[i][j].push(combTest[combIndex][0]);
        equipes[i][j].push(combTest[combIndex][1]);
        cumul[tireurs[j]]["partenaires"].push(combTest[combIndex][0]);
        cumul[tireurs[j]]["partenaires"].push(combTest[combIndex][1]);
        cumul[i].push(combTest[combIndex][0]);
        cumul[i].push(combTest[combIndex][1]);
        comb.splice(comb.indexOf(combTest[combIndex]), 1);
        if(equipes[i][j].length < 3) { return getUniqueTeams(); }
      }
    }
    return equipes;
  }

  function getMatchs(equipes) {
    var matchs          = [];
    var nbEquipesParTour = equipes[0].length;
    var nbMatchsParTour = (equipes[0].length/2);
    for (var i = 0; i < $tour; i++) {
      matchs[i] = [];
      for (var j = 0; j < nbMatchsParTour; j++) {
        matchs[i][j] = [];
        matchs[i][j].push(equipes[i][j]);
        matchs[i][j].push(equipes[i][nbEquipesParTour-1-j]);
      }
    }
    return matchs;
  }

  function getUniqueMatchs(equipes) {
    console.log("getUniqueMatchs", $seuilMatchs);
    var cumul       = [];
    var matchs      = [];
    var tmpEquipes  = copyArray(equipes);
    var numeroMatch = 0;
    var advExist    = true;
    var seuilTour   = 0;
    var equipeIndex = 0;
    var test   = false;
    for (var i = 0; i < $tour; i++) {
      matchs[i] = [];
      numeroMatch = 0;
      matchs[i][numeroMatch] = [];
      matchs[i][numeroMatch].push(tmpEquipes[i][0]);
      // console.log("ajout adversaire", i, numeroMatch, tmpEquipes[i][0]);
      tmpEquipes[i].splice(0, 1);
      advExist = false;
      shuffle(tmpEquipes[i]);
      equipeIndex = 0;
      while (tmpEquipes[i].length > 0) {
        if(typeof matchs[i][numeroMatch] == 'undefined') { // La première équipe peut être n'importe laquelle
          matchs[i][numeroMatch] = [];
          matchs[i][numeroMatch].push(tmpEquipes[i][equipeIndex]);
          // console.log("ajout adversaire", i, numeroMatch, tmpEquipes[i][equipeIndex]);
          tmpEquipes[i].splice(equipeIndex, 1);
          advExist = true;
        } else { // Pour la deuxième
          for (var l = 0; l < 3; l++) { // on teste pour les 3 joueurs qu'ils ne sont pas déjà tombés sur les adversaires de l'autre équipe (paire)
            for (var k = 0; k <= i; k++) { // On regarde les tours d'avant et l'actuel
              if (
                $seuilEquipes < 20
                && typeof cumul[tmpEquipes[i][equipeIndex][l]] != 'undefined'
                && typeof cumul[tmpEquipes[i][equipeIndex][l]]["adversaires"][k] != 'undefined'
              ) {
                tmpCumul = (cumul[tmpEquipes[i][equipeIndex][l]]["adversaires"][k].indexOf(matchs[i][numeroMatch][0][0]) != -1) ? 1 : 0;
                tmpCumul += (cumul[tmpEquipes[i][equipeIndex][l]]["adversaires"][k].indexOf(matchs[i][numeroMatch][0][1]) != -1) ? 1 : 0;
                tmpCumul += (cumul[tmpEquipes[i][equipeIndex][l]]["adversaires"][k].indexOf(matchs[i][numeroMatch][0][2]) != -1) ? 1 : 0;
                if(tmpCumul > Math.floor($tour/2)) {
                  advExist = true;
                  break;
                }
              }
            }
            if (advExist) {
              equipeIndex++;
              if (equipeIndex >= tmpEquipes[i].length) { // On n'a pas trouvé de combinaison
                if (seuilTour++ < 20) {
                  tmpEquipes[i] = copyArray(equipes[i]); // on réessaye en remélangeant les équipes pour ce tour
                  matchs[i] = [];
                  matchs[i][numeroMatch] = [];
                  matchs[i][numeroMatch].push(tmpEquipes[i][0]);
                  tmpEquipes[i].splice(0, 1);
                  // On remet à zéro les adversaires de ce tour
                  for (key in cumul) {
                    if (cumul.hasOwnProperty(key)) {
                      cumul[key]["adversaires"][i] = [];
                    }
                  }
                  numeroMatch = 0;
                  shuffle(tmpEquipes[i]);
                  equipeIndex = 0;
                } else { // Au bout d'un moment on recommence tout le processus
                  return $seuilMatchs++ < 20 ? getUniqueMatchs(equipes) : false;
                }
              }
              break;
            }
          }
        }
        if(false === advExist) {
          matchs[i][numeroMatch].push(tmpEquipes[i][equipeIndex]);
          for (var l = 0; l < 3; l++) {
            if (typeof cumul[tmpEquipes[i][equipeIndex][l]] == 'undefined') {
              cumul[tmpEquipes[i][equipeIndex][l]] = [];
              cumul[tmpEquipes[i][equipeIndex][l]]["adversaires"] = [];
            }
            cumul[tmpEquipes[i][equipeIndex][l]]["adversaires"][i] = matchs[i][numeroMatch][0];
            if (typeof cumul[matchs[i][numeroMatch][0][l]] == 'undefined') {
              cumul[matchs[i][numeroMatch][0][l]] = [];
              cumul[matchs[i][numeroMatch][0][l]]["adversaires"] = [];
            }
            cumul[matchs[i][numeroMatch][0][l]]["adversaires"][i] = matchs[i][numeroMatch][1];
          }
          // console.log("ajout adversaire", i, numeroMatch, tmpEquipes[i][equipeIndex]);
          numeroMatch++;
          tmpEquipes[i].splice(equipeIndex, 1);
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
    for (i = 0; len = matchs.length, i<len; i++) { // Chaque tour
      $("#liste").append('<strong>Partie N°'+(i+1)+'</strong><br/>');
      for (var j = 0; leni = matchs[i].length, j<leni; j++) { // Chaque match
        var temp = matchs[i][j].slice();
        for (var k = 0; k < 2; k++) { // Chaque équipe
          if(impaire(k)) {
            $("#liste").append('<select id="team-'+i+'-'+j+'-'+k+'" data-tour="'+i+'" data-tireur="'+temp[k][0]+'" data-milieu="'+temp[k][1]+'" data-pointeur="'+temp[k][2]+'" class="inbl score 0-13 odd" />');
            $("#liste").append('<label for="team-'+i+'-'+j+'-'+k+'" class="odd">' + temp[k][0] + ' / ' + temp[k][1] + ' / ' + temp[k][2] + '</label>');
            $("#liste").append('<br/>');
          } else {
            $("#liste").append('<label for="team-'+i+'-'+j+'-'+k+'">' + temp[k][0] + ' / ' + temp[k][1] + ' / ' + temp[k][2] + '</label>');
            $("#liste").append('<select id="team-'+i+'-'+j+'-'+k+'" data-tour="'+i+'" data-tireur="'+temp[k][0]+'" data-milieu="'+temp[k][1]+'" data-pointeur="'+temp[k][2]+'" class="inbl score 0-13" />');
          }
        }
      }
    }
    appendScoreList($("#liste"));
  }

  function combinaisons() {
    var indices = [];
    var lengths = [];
    var joueurs = [];
    joueurs.push(milieux);
    joueurs.push(pointeurs);
    for (i = 0; len = joueurs.length, i<len; i++) {
      indices[i] = 0;
      lengths[i] = joueurs[i].length;
    }
    var combinaisons = [];
    while (indices[0] < lengths[0]) {
      var row = [];
      for (i = 0; len = indices.length, i<len; i++) {
        row.push(joueurs[i][indices[i]]);
      }
      combinaisons.push(row);
      /* Cycle the indexes */
      for (j = indices.length-1; j >= 0; j--) {
        indices[j]++;
        if (indices[j] >= lengths[j] && j != 0) {
          indices[j] = 0;
        } else {
          break;
        }
      }
    }
    return combinaisons;
  }

  function initScores(joueurs) {
    for (var i = 0; len = joueurs.length, i<len; i++) {
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
    paintRepartition();
    initScores(tireurs);
    initScores(milieux);
    initScores(pointeurs);
    paintScores(false);
    paintMatchs([]);
  };

  this.add = function(type, index, joueur)
  {
    if("tireurs" == type) {
      tireurs.splice(index, 0, joueur);
    } else if ("milieux" == type) {
      milieux.splice(index, 0, joueur);
    } else if ("pointeurs" == type) {
      pointeurs.splice(index, 0, joueur);
    } else {
      maxLength = Math.max(tireurs.length, milieux.length, pointeurs.length);
      if ((-1 == tireurs.indexOf(joueur)) && (-1 == milieux.indexOf(joueur)) && (-1 == pointeurs.indexOf(joueur))) {
        if(tireurs.length == maxLength) {
          if(milieux.length == maxLength) {
            pointeurs.push(joueur);
          } else {
            milieux.push(joueur);
          }
        } else {
          tireurs.push(joueur);
        }
      }
    }
    self.paint();
  };

  this.remove = function(type, index)
  {
    if ("" != type) {
      if ("tireurs" == type) {
        tireurs.splice(index, 1);
      } else if ("milieux" == type) {
        milieux.splice(index, 1);
      } else if ("pointeurs" == type) {
        pointeurs.splice(index, 1);
      }
    } else {
      if (tireurs.indexOf(index) != -1) {
        tireurs.splice(tireurs.indexOf(index), 1);
      } else if (milieux.indexOf(index) != -1) {
        milieux.splice(milieux.indexOf(index), 1);
      } else if (pointeurs.indexOf(index) != -1) {
        pointeurs.splice(pointeurs.indexOf(index), 1);
      }
    }
    self.paint();
  };

  this.move = function(type, oldIndex, newIndex)
  {
    if ("" != type) {
      if ("tireurs" == type) {
        tireurs.move(oldIndex, newIndex);
      } else if ("milieux" == type) {
        milieux.move(oldIndex, newIndex);
      } else if ("pointeurs" == type) {
        pointeurs.move(oldIndex, newIndex);
      }
    }
    self.paint();
  };

  this.clear = function()
  {
    // tireurs = milieux = pointeurs = [];
    // paint(-1);
  };

  this.start = function(nbTeams)
  {
    $scores = [];
    $("#tableauRepartition").show();
    $("#typeInter").val('0');
    $("#inter").addClass("melee");
    $("#inter").removeClass("point");
    for (index = 0; index < nbTeams; ++index) {
      self.add("", 0, teams.name(index));
    }
    self.paint();
  };
}

var inter = new Inter($('#inter'));