/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import jquery from 'jquery';
import './styles/app.scss';

// start the Stimulus application
// import './bootstrap';

const $ = require('jquery');//pour utiliser jquery
global.$ = global.jQuery = $; // fix un probleme d'utilisation de la variable $ 
require('bootstrap'); // pour utiliser le js de bootstrap


jQuery(document).ready(function() {
    var searchRequest = null;
    $("#search").on("keyup", function() {
        var minlength = 3;
        var that = this;
        var value = $(this).val();
        var entitySelector = $("#entitiesNav").html('');
        if (value.length >= minlength ) {
            if (searchRequest != null)  searchRequest.abort();
            searchRequest = $.ajax({
                type: "GET",
                url: "/search",
                data: {
                    'q' : value
                },
                dataType: "json",
                success: function(msg){
                  

                    if (value==$(that).val()) {
                                        
                        // var result = msg;
                        console.log(msg)
                        $.each(msg, function(key, arr) {


                          
                            $.each(arr, function(id, value) {
                                
                                if (key == 'entities') {
                                    if (id != 'error') {
                                        entitySelector.append('<li class="list-group-item result_bar"><a href="/daten/">'+value+'</a></li>');
                                        
                                    } else {
                                        entitySelector.append('<li class="errorLi list-group-item">'+value+'</li>');
                                    }
                                }
                            });

                            if(key == 'entities'){


                                $(".result_bar").on({
                                    mouseenter: function () {
                                        $(this).toggleClass('active');
                                        
                                    },
                                    mouseleave: function () {
                                        $(this).toggleClass('active');
                                       
                                    }
                                });

                                $(".result_bar").on('click', function(){
                                    let mot = $(this).text()
                                    console.log('mot = '+mot)
                                    $('#search').val(mot)
                                })
                            }
                        });


                    }
                 }
            });
        }
    });
});


// if(typeof key != 'undefined'){
//     console.log(key)
//     let rb = document.querySelector('.result_bar')
//     console.log(typeof(rb))
//     console.log('test')
// }



// for(var i = 0; i < relenght; i++){
//     rb.addEventListener('mouseover', () => {
//         this.classList.toggle('active');
//         console.log('prout')
//     });

// }

// $(".result_bar").on({
//     mouseenter: function () {
//         $('.result_bar').toggleClass('active');
//         console.log('test')
//     },
//     mouseleave: function () {
//         $(this).toggleClass('active');
//         console.log('test-out')
//     }
// });

// $('.result_bar').on('mouseover', function() {
    
//         $(this).toggleClass('active');
//         console.log('test')
       
   


// });




// commande avec un each pour récup plusieurs éléments
// jQuery(document).ready(function() {
//     var searchRequest = null;
//     $("#search").on("keyup", function() {
//         var minlength = 3;
//         var that = this;
//         var value = $(this).val();
//         var entitySelector = $("#entitiesNav").html('');
//         if (value.length >= minlength ) {
//             if (searchRequest != null)  searchRequest.abort();
//             searchRequest = $.ajax({
//                 type: "GET",
//                 url: "/search",
//                 data: {
//                     'q' : value
//                 },
//                 dataType: "json",
//                 success: function(msg){
//                     console.log("value :" +value)
//                     //we need to check if the value is the same
//                     if (value==$(that).val()) {
//                         console.log("test")
//                         console.log('msg = '+msg)
//                         var result = JSON.parse(msg);
//                         console.log( 'result'+result)
//                         $.each(result, function(key, arr) {
//                             $.each(arr, function(value) {
//                                 if (key == 'entities') {
//                                     if (id != 'error') {
//                                         entitySelector.append('<li><a href="/daten/">'+value+'</a></li>');
//                                     } else {
//                                         entitySelector.append('<li class="errorLi">'+value+'</li>');
//                                     }
//                                 }
//                             });
//                         });
//                     }
//                  }
//             });
//         }
//     });
// });