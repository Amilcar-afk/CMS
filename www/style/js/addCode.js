$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-code", function () {
        $.ajax({
            url:"/add-code/compose",
            type:"POST",
            data:
                {
                    headCode:$('#headCode').val(),
                    footerCode:$('#footerCode').val(),
                },
            success:function()
            {
                alertMessage('Code saved!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});
