// Todos Collection/View
function Barrages($element) {
  var collection = [];
  var $el = $element;

  this.paint = function(col) {
    pre = $el.find("pre");
    pre.html('');
    collection = shuffle(col);
    for (var i = 0, len = collection.length; i<len; i++) {
      pre.append(
        '<div class="teamMatch" data-id="' + collection[i].id + '" data-order-"' + i + '">' +
          '<label for="team'+i+'">' + collection[i].title + '</label>' +
          // '<input type="number" data-id="' + collection[i].id + '" class="matchScore' + (impair(i)?' impair':'') + '" />' +
        '</div>'
      );
    }
  }
}

var orga = new Barrages($('#organisation'));

// handle creating a new task
$('#randomize').on('click', function(event) {
  teams.refresh();
});