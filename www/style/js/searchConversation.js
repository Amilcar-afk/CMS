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
                                createNewConversation(element.id)
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
        if($('#sendTextarea').val() != ''){
            var currentUserData = {
                id_user:$('#userId').val(),
                message:$('#sendTextarea').val(),
                id_conversation:$('#conversationId').val(),
            };

            $.ajax({
                url: "/conversation/compose",
                dataType:"html",
                type: "POST",
                data:
                {
                    id_user:currentUserData.id_user,
                    message:currentUserData.message,
                    id_conversation:currentUserData.id_conversation,
                },
                success: function(data){
                }
            });
            $('#sendTextarea').val('');
        }
    });

    function createNewConversation(userId){
        $.ajax({
            url: "/conversation/compose-newconversation",
            dataType:"html",
            type: "POST",
            data:
            {
                userId:userId,
            },
            success: function(data){
                conversationId =JSON.parse(data)
                window.location.replace("/conversations/user-conversations/"+conversationId)
            }
        });

    }

    var allMessages = [];

    function getMessages(){
        setInterval(() => {
            $.ajax({
                url: "/conversations/get-all-messages",
                dataType:"json",
                type: "POST",
                data:{
                    id :$('#conversationId').val(),
                },
                success: function(messages){ 
                    allMessages = messages
                    data = {
                            id :messages[0]['id'] ,
                            id_conv :$('#conversationId').val(),
                        }
                    gertNewMessage(data)
                }
            });
        }, 1000);
    }

    
    function gertNewMessage(data){
        setTimeout(() => {
            $.ajax({
                url: "/conversations/newmessage",
                dataType:"json",
                type: "POST",
                data:{
                    id :data.id,
                    id_conv :data.id_conv,
                },
                success: function(messages){ 
                    $('#chatDiv').empty();
                    allMessages.forEach(message =>{
                        
                        date = new Date( message.date)
                        const current = date.getHours()+ ':' + date.getMinutes();

                    $('<div>' + message.content + ''+ current +'</div>').prependTo('#chatDiv');
                })

              
            }
        });
        }, 400);
    }
    
    
    getMessages()
})

