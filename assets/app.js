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


$(function() {
        var searchRequest = null;
        $("#search").on("keyup", function(e) {
            if( e.key !== 'ArrowDown'&& e.key !== 'ArrowUp'){

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

                                            //création des <li> de suggestion

                                            if (id != 'error') {

                                                //vérification de la value pour ne pas pouvoir la rentrer deux fois

                                                if (Object.values(tags).indexOf(value) > -1) {
                                                    console.log('has value');
                                                 }else{
                                                    entitySelector.append('<li class="list-group-item result_bar" id="es'+i+'"><span class="value">'+value+'</span></li>');
                                                    i++
                                                 }
                                            } else {
                                                entitySelector.append('<li class="errorLi list-group-item result_bar">'+value+'</li>');
                                            }
                                        }
                                    });
                                    
                                });
                            }

                            //Event mouseOver

                            $(".result_bar").on({
                                mouseenter: function () {
                                    if(!$(this).hasClass('errorLi')){
                                        $(".result_bar").removeClass('active select')
                                        $(this).toggleClass('active');
                                        let mot = $(this).text()
                                        $('#search').val(mot)
                                    }
                                },
                                mouseleave: function () {
                                    $(this).toggleClass('active');
                                    $('#search').val('')
                                    
                                }
                            });
                            //Event click remplisage de l'input                                
                            $(".result_bar").on('click', function(){

                                if(!$(this).hasClass('errorLi')){
                                    
                                    entitySelector.text('');

                                    
                                        input.value.split(',').forEach(tag => {
                                            tags.push(tag);
                                            
                                        });  
                                        addTags();
                                        input.value = '';  
                                }
                            })

                            //reset des champs au click sur le document
                            document.addEventListener('click', (e) => {
                                input.value = '';
                                entitySelector.text('');
                            })

                            //Preventdefault navigateur                                
                            document.getElementById('search').addEventListener('keydown', function(e) {
                                if (e.key === 'ArrowDown' || e.key === 'ArrowUp'||e.key === 'Enter') {
                                    e.preventDefault();
                                }
                            });
                            
                            //Event navigation liste fleches                                

                            var k= -1;
                            input.addEventListener('keydown', (e) =>{

                                if(e.key === 'ArrowDown' && k < $(".result_bar").length-1) {
                                    
                                    $(".result_bar").removeClass('active select')
                                    k++
                                    $('#es'+k).addClass('active select');
                                    
                                    let mots = $('.select').text()
                                    $('#search').val(mots)  
                                }
                            })

                            input.addEventListener('keydown', (e) =>{

                                if(e.key === 'ArrowUp'&& k > 0){
                                    $(".result_bar").removeClass('active select')
                                    k--
                                    $('#es'+k).addClass('active select');
                                    
                                    let mots = $('.select').text()
                                    $('#search').val(mots)
                                }
                                
                            })

                            //Event remplissage input via touche Enter
                            //----

                            input.addEventListener('keydown', (e) => {
                                
                                if (e.key === 'Enter' ) {
                                    
                                    let mots = $('.select').text()
                                    $('#search').val(mots)
                                    if(input.value != '' && input.value == $('.select').text()){
                                    
                                        enterTag()
                                        
                                        entitySelector.text('');
                                        input.focus();
                                    }
                                }
                            });

                            //fonction création de tag a partir de l'input

                            function enterTag(){
                                input.value.split(',').forEach(tag => {
                                tags.push(tag);  
                                });

                                addTags();
                                input.value = '';

                            }
                        }
                    });
                }
            }
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

        let hidden_input = document.querySelector("[name='js_object']")
        hidden_input.value = tags

        // if(hidden_input.value != ''){
        //     return obj = true;
        // }


        
    }


    document.addEventListener('click', (e) => {
    
    if (e.target.tagName === 'I') {
        const tagLabel = e.target.getAttribute('data-item');
        
            const index = tags.indexOf(tagLabel);
        tags = [...tags.slice(0, index), ...tags.slice(index+1)];
        addTags();
        
            
    }
    })

    //Commande pour valider et lancer la recherche en appuyant sur entrée
    //si le champs de recherche n'est pas validé (décommenter le code dans la fonction "addTags"aussi)

    // input.focus();

    // if(obj == true){
    //     let focus = $('#search').is(':focus');
    //     if(focus = false){

    //         document.addEventListener('keyup', (e) => {
    //             if (e.key === 'Enter' ) {
    //                 document.getElementById("search-btn").click();           
    //             }
    //         });



    //     }
    // }





});



