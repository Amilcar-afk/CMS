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
                    $('#conversations-elements').hide();


                    conversations.forEach(element => {
                        console.log(1)

                // console.log(element)

                        if(element.firstname.indexOf(value) || element.lastname.indexOf(value)  || element.email.indexOf(value)  ){
                            $(".select").on("input", function() {
                                $('#conversation-founded').show()
                                document.getElementById('conversation-founded').innerHTML = "";
                                document.getElementById('chat-conversations-elements').innerHTML = "";
                            })
                            if(element.firstname != value){
                                $('#chat-conversations-elements').hide();   
                                $('').prependTo('#conversation-founded');
                                div = '<p id="foundedUser"  >'
                                    + element.firstname  +'<br>' 
                                    + element.lastname +'<br>' 
                                    + element.email +' </p> <br><br>';
                                    $('#foundedUser').css('width','100%');
                                    $('#foundedUser').css('margin-top','2%');
                                $(div).prependTo('#conversation-founded');
                            } 
                            $('#foundedUser').on('click', function(){
                                window.location.href = "conversations/user-conversations/"+element.id
                            })
                        }
                    })
                }else{
                    document.getElementById('conversation-founded').innerHTML = "";
                    $('#conversations-elements').show();
                }
            }
        });
     });


    $('#sendButton').on('click',function(){
        var currentUserData = {
            id_user:$('#userId').val(),
            message:$('#sendTextarea').val(),
        };
        sendMessage(currentUserData);
    })

    $('#existingConversation').on('click',function(e){
        console.log(e)
        // var currentUserData = {
        //     id_user:$('#userId').val(),
        //     message:$('#sendTextarea').val(),
        // };
        // sendMessage(currentUserData);
    })


    function sendMessage(data){
        $.ajax({
            url: "/conversation/compose",
            dataType:"html",
            type: "POST",
            data:
            {
                id_user:data.id_user,
                message:data.message,

            },
            success: function(data){
            }
        });
    }
})

