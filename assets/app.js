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

const $ = require('jquery');
global.$ = global.jQuery = $; 
require('bootstrap'); 


jQuery(document).ready(function() {
    var searchRequest = null;
    $("#search").on("keyup", function(e) {
       if( e.key !== 'ArrowDown'&& input.keyCode !== '38' ){
        if(e.key !== 'ArrowUp'&& input.keyCode !== '40'){

        

        
        
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
                                        
                        
                        $.each(msg, function(key, arr) {


                            let i = 0
                            $.each(arr, function(id, value) {
                                
                                if (key == 'entities') {
                                    
                                    if (id != 'error') {
                                        
                                        entitySelector.append('<li class="list-group-item result_bar" id="es'+i+'"><span >'+value+'</span></li>');
                                        i++

                                        
                                        
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
                                    
                                    $('#search').val(mot)
                                    entitySelector.text('');
                                    return mot

                                })

                                
                                document.getElementById('search').addEventListener('keydown', function(e) {
                                    if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                                        e.preventDefault();
                                    }
                                });
                                  



                                var k= 0;
                               input.addEventListener('keydown', (e) =>{
                                
                                    if(e.key === 'ArrowDown' && k < $(".result_bar").length){
                                        
                                        $('#es'+k).toggleClass('active');
                                        $('#es'+(k -1)).toggleClass('active');
                                        
                                        k++
                                        
                                    }
                                })
                                input.addEventListener('keydown', (e) =>{
                                
                                    if(e.key === 'ArrowUp'){
                                        
                                        $('#es'+k).toggleClass('active');
                                        $('#es'+(k +1)).toggleClass('active');
                                        
                                        k--
                                        
                                    }
                                })
                            }
                        });


                    }
                 }
            });
        }
    }
    }
    });
});




//---------------------------------------------
// TAGS 



const tagContainer = document.querySelector('.tag-container');
const input = document.querySelector('.tag-container input');

let tags = [];


function createTag(label) {
  const div = document.createElement('div');
  div.setAttribute('class', 'tag');
  const span = document.createElement('span');
  span.innerHTML = label;
  const closeIcon = document.createElement('i');
  
  closeIcon.setAttribute('class','fa-solid fa-xmark');
  closeIcon.setAttribute('data-item', label);
  div.appendChild(span);
  div.appendChild(closeIcon);
  return div;
}

function clearTags() {
  document.querySelectorAll('.tag').forEach(tag => {
    tag.parentElement.removeChild(tag);
  });
}

function addTags() {
  clearTags();
  
  tags.slice().reverse().forEach(tag => {
    tagContainer.prepend(createTag(tag));
  });

    console.log('test recup objet')
    console.log(tags)
    console.log( 'type = '+typeof tags)
  
    let hidden_input = document.querySelector("[name='js_object']")
    hidden_input.value = tags


    
}

input.addEventListener('keyup', (e) => {
    if (e.key === 'Enter' ) {
      e.target.value.split(',').forEach(tag => {
        tags.push(tag);  
      });
      
      addTags();
      input.value = '';
    }
});




document.addEventListener('click', (e) => {
  
  if (e.target.tagName === 'I') {
    const tagLabel = e.target.getAttribute('data-item');
    
        const index = tags.indexOf(tagLabel);
    tags = [...tags.slice(0, index), ...tags.slice(index+1)];
    addTags();
    
        
  }
})


input.focus();


//-------------- envoie recherche

// searchCompo = $.ajax({
//     type: "GET",
//     url: "/search_compo",
//     data: {
//         'c' : tags
//     },
//     dataType: "json",
//     success: function(msg){
      


//      }
// });






