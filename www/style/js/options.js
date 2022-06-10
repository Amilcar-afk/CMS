$(document).ready(function(){
    $(".cta-button--mains-color--custom").click(function (e) {
           console.log(e.currentTarget.id)
        $('.e').change(function(){
            $('.sp-choose').click(function(e){
                console.log($('.e').val())
                $('.e').remove()
            })
        })
    })
});

