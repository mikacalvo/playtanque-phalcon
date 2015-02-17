// // Match Collection/View
// function Match($element) {
//   var collection = [];
//   var $el = $element;
//   var $tour = -1;

//   // Handle marking team as "done"
//   $el.on('click', 'input[type=submit]', function() {
//     // hoodie.store.remove('team', $(this).parent().data('id'));
//     return false;
//   });

//   // Handle "inline editing" of a team.
//   $el.on('click', 'label', function() {
//     $(this).parent().parent().find('.editing').removeClass('editing');
//     $(this).parent().addClass('editing');
//     return false;
//   });

//   // Handle updating of an "inline edited" team.
//   $el.on('keypress', 'input[type=text]', function(event) {
//     if (event.keyCode === 13) {
//       // hoodie.store.update('team', $(this).parent().data('id'), {title: event.target.value});
//     }
//   });

//   // Find index/position of a team in collection.
//   function getTodoItemIndexById(id) {
//     for (var i = 0, len = collection.length; i < len; i++) {
//       if (collection[i].id === id) {
//         return i;
//       }
//     }
//     return null;
//   }

//   function paint(tour) {
//     if(-1 === tour) {
//       $el.html('');
//     } else {
//       $tour = $('.tour[data-id="'+tour+'"]');
//       $tour.html('');
//       for (var i = 0, len = collection[tour].length; i<len; i++) {
//         $tour.append(
//           '<div class="match' + (impair(i)?' odd':'') + '" data-id="' + i + '">' +
//             '<label for="team'+i+'">' + ((0 === tour) ? collection[0][i] : collection[0][collection[tour][i]]) + '</label>' +
//             '<select id="team'+i+'"" data-odd="' + (impair(i)?'true':'false') + '" class="mas score 0-13" />' +
//           '</div>'
//         );
//       }
//       appendList($tour);
//     }
//   }

//   function tours(nbTeams) {
//     nbTours = Math.floor(nbTeams/2)-1;
//     for (var i = 0; i<nbTours; i++) {
//       collection[i] = [];
//       $el.append(
//         '<section class="tour w200p pam mas" data-id="' + i + '" style="background:#' + (999999 - 111*i) + ';"></section>'
//       );
//     }
//   }

//   this.add = function(tour, id) {
//     collection[tour].push(id);
//     paint(tour);
//   };

//   this.remove = function(tour, id) {
//     console.log(id);
//     console.log(collection[tour]);
//     if ((idx = collection[tour].indexOf(id)) !== -1) {
//       console.log(idx);
//       collection[tour].splice(idx, 1);
//     }
//     paint(tour);
//   };

//   this.clear = function() {
//     collection = [];
//     paint(-1);
//   };

//   this.start = function(teams) {
//     // créer un nombre de tour en fonction du nombre d'équipes
//     tours(teams.length);
//     // mettre en place le premier tour
//     collection[0] = teams;
//     paint(0);
//   };
// }

// $('#content').on('change', 'select.score', function() {
//   if(13 == $(this).val()) {
//     match.add($(this).parents(".tour").data("id")+1, $(this).parent().data("id"))
//   } else {
//     match.remove($(this).parents(".tour").data("id")+1, $(this).parent().data("id"))
//   }
// });