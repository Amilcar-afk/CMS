$(document).ready(function(){
$('#chat-conversations-elements').hide();

    $(".select").on("input", function() {
        var value = $(this).val()     
        

        $.ajax({
            url: "conversations/search-conversations",
            dataType:"html",
            type: "POST",
            data:
            {
                searchData:$(this).val(),
            },
            success: function(data){
                var conversations = JSON.parse(data)
                var div ;
                if( value.length != 0){
                    conversations.find(element =>{
                        if(element.firstname.indexOf(value) || element.lastname.indexOf(value)  || element.email.indexOf(value)  ){
                            $(".select").on("input", function() {
                                $('#conversation-founded').show()
                                document.getElementById('conversation-founded').innerHTML = "";
                            })

                            if(element.firstname != value){
                                $('#chat-conversations-elements').hide();   
                                $('#empty-conversations-elements').hide();
                                $('').prependTo('#conversation-founded');
                                console.log(element.firstname);
                                div = '<p id="e"  >'
                                    + element.firstname  +'<br>' 
                                    + element.lastname +'<br>' 
                                    + element.email +' </p> <br><br>';
                                    $('#e').css('width','100%');
                                    $('#e').css('margin-top','2%');
                                $(div).prependTo('#conversation-founded');
                            } 

                            $('#e').on('click', function(){
                                
                                $('#userData').hide()

                                $('#conversation-founded').hide();
                                $('#empty-conversations-elements').hide();
                                $('#chat-conversations-elements').show();   
                                $('#chat-conversations-elements').append(
                                    "<p id='userData'> Nom: "+ element.lastname+"</p>" +
                                    "<p id='userData'> Prenom: "+element.firstname +"</p>" +
                                    "<p id='userData'> Email: "+ element.email+"</p>" 

                                );
                                console.log(element)
                            })


                        }
                    })

                }else{
                    document.getElementById('conversation-founded').innerHTML = "";
                    $('#empty-conversations-elements').show();

                }
            }
        });
     });
})

