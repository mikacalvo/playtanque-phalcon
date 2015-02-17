// function Concours($element) {
//   var collection = [];
//   var $el = $element;

//   // Handle "inline editing" of a concours.
//   $el.on('click', 'label', function() {
//     if($(this).parent().parent().hasClass("editableElement")) {
//       $(this).parent().parent().find('.editing').removeClass('editing');
//       $(this).parent().addClass('editing');
//     }
//     else {
//       $("#currentConcours").val($(this).parent().data('id'));
//       changeView("team");
//       teams.refresh();
//     }
//     return false;
//   });

//   // Handle marking team as "done"
//   $el.on('click', 'span.delete', function() {
//     hoodie.store.remove('concours', $(this).parent().data('id'));
//     return false;
//   });

//   // Handle updating of an "inline edited" concours.
//   $el.on('keypress', 'input[type=text]', function(event) {
//     if (event.keyCode === 13) {
//       hoodie.store.update('concours', $(this).parent().data('id'), {title: event.target.value});
//     }
//   });

//   // Find index/position of a concours in collection.
//   function getTodoItemIndexById(id) {
//     for (var i = 0, len = collection.length; i < len; i++) {
//       if (collection[i].id === id) {
//         return i;
//       }
//     }
//     return null;
//   }

//   function paint() {
//     $el.html('');
//     for (var i = 0, len = collection.length; i<len; i++) {
//       $el.append(
//         '<li data-id="' + collection[i].id + '">' +
//           '<span class="glyphicon glyphicon-trash delete" aria-hidden="true"></span>'+
//           '<label>'+collection[i].title + '</label>' +
//           '<input type="text" value="' + collection[i].title + '"/>' +
//         '</li>'
//       );
//     }
//   }

//   this.add = function(concours) {
//     collection.push(concours);
//     paint();
//   };

//   this.update = function(concours) {
//     collection[getTodoItemIndexById(concours.id)] = concours;
//     paint();
//   };

//   this.remove = function(concours) {
//     collection.splice(getTodoItemIndexById(concours.id), 1);
//     paint();
//   };

//   this.clear = function() {
//     collection = [];
//     paint();
//   };

//   this.refresh = function() {
//     paint();
//   };
// }

// var concours = new Concours($('#myprojects'));

