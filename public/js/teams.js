function Teams($element) {
  var collection = [];
  var $el = $element;
  var self = this;

  $el.on('click', '.delete', function (event) {
    self.remove($(this).parent().data("id"));
  });

  $el.on('click', 'label.editable', function (event) {
    $(this).hide();
    $(this).next().show();
    $(this).next().select();
  });

  $el.on('keypress', 'input.editable', function (event){
    if (event.keyCode === 13) {
      $(this).hide();
      $(this).prev().show();
      if(!$.trim($(this).val())) return false;
      self.update($(this).parent().data("id"), $(this).val());
    }
  });

  $el.on('focusout', 'input.editable', function() {
    $(this).hide();
    $(this).prev().show();
    if(!$.trim($(this).val())) return false;
    self.update($(this).parent().data("id"), $(this).val());
  });

  // Find index/position of a team in collection.
  function getTodoItemIndexById(id) {
    for (var i = 0, len = collection.length; i < len; i++) {
      if (collection[i].id === id) {
        return i;
      }
    }
    return null;
  }

  function paint() {
    $el.html('');
    for (var i = 0, len = collection.length; i<len; i++) {
      if(collection[i].concours == $("#currentConcours").val()) {
        $el.append(
          '<li data-id="' + i + '">' +
            '<i class="fa fa-trash delete" id="addteam"></i>'+
            '<label class="man editable">'+collection[i] + '</label>' +
            '<input type="text" class="dark editable" value="' + collection[i] + '"/>' +
          '</li>'
        );
      }
    }
    $('#nbEquipes').html(len + ' <span class="tiny-hidden">équipe'+(len>1?'s':'')+'</span>');
    if($('.navspan.active.restart').length != 0) {
      $('#startConcours').trigger("click");
    }
  }

  this.add = function(team) {
    if($('.navspan.active.dynamic').length != 0) {
      concours.add("", 0, team);
    }
    collection.push(team);
    paint();
  };

  this.update = function(index, team) {
    collection[index] = team;
    paint();
  };

  this.remove = function(index) {
    if($('.navspan.active.dynamic').length != 0) {
      concours.remove("", collection[index]);
    }
    collection.splice(index, 1);
    paint();
  };

  this.clear = function() {
    collection = [];
    paint();
  };

  this.refresh = function() {
    paint();
  };

  this.shuffle = function() {
    shuffle(collection);
    return collection;
  };

  this.collection = function() {
    return collection;
  };

  this.name = function(index) {
    return collection[index];
  };

  this.length = function() {
    return collection.length;
  };
}

var teams = new Teams($('#teamlist'));

function addTeam(element) {
  if(!$.trim(element.val())) return false;
  teams.add(element.val());
  element.val('');
}
$('#teaminput').on('keypress', function(event) {
  if (event.keyCode === 13) {
    addTeam($(this));
  }
});
$('#addteam').on('click', function(event) {
  addTeam($('#teaminput'));
});

$('#addteam-mobile').on('click', function(event) {
  $('#teaminput').focus();
});

