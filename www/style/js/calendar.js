$(document).ready(function() {
  var rank = [];

  $('#meeting_inputs').hide();

  console.log(location.pathname)


  // $('.cta-button.cta-button-a.cta-button--submit.cta-button--submit--add').on('click',function(){
  //     $('.a-zoom-out-end').css('display','block')
  // })


  //il faut supprimer le // a:not([href]) {pointer-events:none// du css pour pouvoir manipuler le calandrier 
  const calendar = $('#calendar').fullCalendar({   

    lang: 'fr',
    editable:true,
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },

    // LOAD EVENTS /////////////////////////////////////////////

    events: function(start, end, timezone, callback) { 
      if(location.pathname == '/slots'){
        $.ajax({
            method: 'POST',
            url:"/load",
            color: '#000',
            dataType: 'json',
            success: function(events) {
              callback(events);
              events.map((e)=>{
                rank.push(e.rank);
              })
            }
        });
      }else if(location.pathname == '/meetings'){
        $.ajax({
          method: 'POST',
          url:"/loadmeetings",
          color: '#000',
          dataType: 'json',
          success: function(events) {

            console.log(events)
            callback(events);
            events.map((e)=>{
              rank.push(e.rank);

            })
          }
        });
      }
      

    },  

    // INSERT EVENTS /////////////////////////////////////////////

    minTime: '09:00:00', 
    maxTime: '21:00:00', 
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay,event)
    {
      if(rank[0] == 'admin'){
        if(start.isBefore(moment())) {
          $('#calendar').fullCalendar('unselect');
          alert('Impossible de séléctionnez cette date')
          // document.location.reload();
          console.log(1)
         }else{
          var start = moment(start).format("Y-MM-DD HH:mm:ss");
          var end = moment(end).format("Y-MM-DD HH:mm:ss");
          $.ajax({
            url:"/slot/compose",
            type:"POST",
            data:
            {
                  start:start,
                  end:end,
            },
              success:function(session)
              {
                confirm('insertion reussie');
                calendar.fullCalendar('refetchEvents');
                document.location.reload();
              }
            })
          }
      }else{
        document.location.reload();
      }
    },

    editable:true,
    eventDrop:function(event)
    {
    if(event.rank == 'admin'){
        var start = moment(event.start).format("Y-MM-DD HH:mm:ss");
        var end = moment(event.end).format("Y-MM-DD HH:mm:ss");
        var id = event.id;
        $.ajax({
          url:"/slot/compose",
          type:"POST",
          data:{start:start, end:end, id:id},
          success:function()
          {
          calendar.fullCalendar('refetchEvents');
          alert("Event Updated");
          }
        });
      }else{
        calendar.fullCalendar('refetchEvents');
      }
    },

    editable:true,
    eventResize:function(event)
    {
      if(event.rank == 'admin'){
        var start = moment(event.start).format("Y-MM-DD HH:mm:ss");
        var end = moment(event.end).format("Y-MM-DD HH:mm:ss");
        var id = event.id;
        $.ajax({
          url:"/slot/compose",
          allDay: true,
          type:"POST",
          data:{start:start, end:end, id:id},
          success:function(){
          calendar.fullCalendar('refetchEvents');
          alert('Event Update');
          }
        })
      }else{
        calendar.fullCalendar('refetchEvents');
      }
    },

    // DELETE EVENTS /////////////////////////////////////////////

    eventClick:function(event)
    {
      if(event.rank == '1'){
        
        if(confirm("Vous etes sur de supprimer de rendez-vous"))
        {
         var id = event.id;
         $.ajax({
          url:"/slot/delete",
          type:"POST",
          data:{id:id},
          success:function()
          {
           calendar.fullCalendar('refetchEvents');
           alert("Event Removed");
          }
         })
        }
      }else{
        if(confirm("vous etes sur de choiosir ce rendez-vous")){
          $('#meeting_inputs').show()
          $('.cta-button.cta-button--submit.col-12').on('click',function(e){
             var id = event.id;
             $.ajax({
              url:"/meeting/compose",
              type:"POST",
              data:{
                id:id,
                title: $('.title_rdv').val(),
                location: $('.location').val(),
                description: $('.description').val(),
              },
              success:function()
              {
                // calendar.fullCalendar('refetchEvents');
                if ( window.history.replaceState ) {
                  window.history.replaceState( null, null, window.location.href );
              }
                alert("rendez-vous choisie");
              },
             })
          })
        }
      }
    },

    // EMPECHER DE SELECTIONNER UNE DATE EXISTANTE
    selectOverlap: function(event) {
      return false
    },
  });
});
  