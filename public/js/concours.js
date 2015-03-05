window.onbeforeunload = function(){
  // return 'En quittant, vous perdrez toutes vos données.';
};

if(!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(what, i) {
        i = i || 0;
        var L = this.length;
        while (i < L) {
            if(this[i] === what) return i;
            ++i;
        }
        return -1;
    };
}

function copyArray(array) {
  var newArray = array.map(function(arr) {
    return arr.slice();
  });
  return newArray;
}

Array.prototype.removeVal = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex ;
  while (0 !== currentIndex) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;
    temporaryValue      = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex]  = temporaryValue;
  }
  return array;
}

function impaire(value) {
  return (value & 1)==1;
}

function appendScoreList(element) {
  var $select = element.find(".0-13:not(.ok)");
  for (i=0;i<=13;i++){
    $select.append($('<option></option>').val(i).html((0==i?'-':i)));
  }
  $select.addClass("ok");
  // $select.after('<input type="text" class="on-print w25p masc" val=""/>')
};


$('.navspan').on('click', function(event) {
  if(!$(this).hasClass("active")) {
    $('.navspan').each(function() {
      $(this).removeClass('active');
    });
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
    console.log("ici");
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
  $('.container').addClass("reduced");
});

$('#show').on('click', function (event) {
  $('.container').removeClass("reduced");
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
  if(!$('#Melee').hasClass('active')) {
    $('#Melee').click();
  }
});

$(document).ready(function() {
    $("#classementIS").tablesorter(
        {
            sortList: [[5,1]]
        }
    );

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
        console.log("Moved " + item.text() + " from " + oldList.attr('id')+"/"+oldIndex + " to " + newList.attr('id')+"/"+ui.item.index());
        concours.add(newList.attr("id"), ui.item.index(), item.text());
        concours.remove(oldList.attr("id"), oldIndex);
        concours.paint();
      },
      change: function(event, ui) {
        if(ui.sender) newList = ui.placeholder.parent();
      },
      helper: 'clone',
      connectWith: '.sortable',
      distance: 5,
    });

    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];

    $("#teaminput").autocomplete({
      source: availableTags
    });
});
