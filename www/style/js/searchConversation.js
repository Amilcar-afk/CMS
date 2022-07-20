$(document).ready(function(){

 
    if(window.location.href.indexOf("/conversations/user-conversations/") > -1) {

        var data = {
            id_user:$('#userId').val(),
            myId:$('#myId').val(),
            conversation_user_id:$('#conversationUser').val(),
            seenValue:$('#seen').val(),
        };
        setInterval(() => {
            getMessages()
            changeSeenStatus(data)
        }, 1000);
    }

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

                if(data == undefined) {

                    $('#conversation-founded').html('');
                    $('#conversations-elements').show();
                    return;
                }

                var div = "";
                if( data != ''){

                    var foundedUsers = JSON.parse(data);

                    $('#conversations-elements').hide();
                    $('#conversation-founded').show();

                    foundedUsers[0].forEach(element => {
                        if (element.firstname && element.lastname && element.email) {

                            div = '<header class="main-nav-choice mb-3 foundedUser" data-id="'+element.id+'">' +
                                '<div>' +
                                '<h2 id="conversation_title">' + element.firstname + ' ' + element.lastname + '<br>' + element.email + '<h2>' +
                                '</div>' +
                                '<span class="material-icons-round">more_horiz</span>' +
                                '</header>' + div;
                        }
                    })

                    $(document).on( "click", ".foundedUser", function () {
                        var e =  foundedUsers[1].find(e=>{
                            return  $(this).attr('data-id') == e.id
                        });
                        if(e == null){
                            createNewConversation($(this).attr('data-id'))
                        }else{
                            window.location.replace("/conversations/user-conversations/"+e.conversation_id)
                        }
                    });

                    $('#conversation-founded').html(div);
                }else{
                    $('#conversation-founded').html('');
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

            var data = {
                id_user:$('#user').val(),
                myId:$('#myId').val(),
                conversation_user_id:$('#conversationId').val(),
                seenValue:$('#seenValue').val(),
            };
            changeSeenStatus(data)


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

    $('#conversation_title').on('click',function(){
        var data = {
            conversation_user_id:$('#userConversationId').val(),
            seenValue: 2,
            id_user:$('#user').val(),
            myId:$('#myId').val(),
        };
        changeSeenStatus(data)
    })

    function changeSeenStatus(data){
        $.ajax({
            url: "/conversations/updateseen",
            dataType:"html",
            type: "POST",
            data:
            {
                conversation_user_id: data.conversation_user_id,
                seenValue: data.seenValue,
                id_user: data.id_user,
                myId:data.myId,
            },
            success: function(data){
            }
        });

    }

    function getMessages(){
        $.ajax({
            url: "/conversations/get-all-messages",
            dataType:"json",
            type: "POST",
            data:{
                id :$('#conversationId').val(),
            },
            success: function(messages){ 
                if($( "#chatDiv > article >p" ).length != messages.length ){

                    if(messages[0].user_key == $('#myId').val()){
                        $( "#chatDiv" ).append(
                            '<article class="message message--mind"><p>'
                            +messages[0]['content']+
                            '</p></article>'
                        )
                    }else{
                        $( "#chatDiv" ).append(
                            '<article class="message "><p>'
                            +messages[0]['content']+
                            '</p></article>'
                        )
                    }

                }
            }
        });
    }
})

