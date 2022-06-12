$(document).ready(function() {
  //il faut supprimer le // a:not([href]) {pointer-events:none// du css pour pouvoir manipuler le calandrier 
  const calendar = $('#calendar').fullCalendar({   
    editable:true,
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },

    // LOAD EVENTS /////////////////////////////////////////////
    events: function(start, end, timezone, callback) {  
      $.ajax({
          method: 'POST',
          url:"/calendar_load",
          color: '#000',
          dataType: 'json',
          success: function(events) {
            callback(events);
          }
      });
    },  

    // INSERT EVENTS /////////////////////////////////////////////

    minTime: '09:00:00', 
    maxTime: '21:00:00', 
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay,event)
    {
    // if(event.rank == 1){
    //   if(start.isBefore(moment())) {
    //     $('#calendar').fullCalendar('unselect');
    //     alert('Impossible de séléctionnez cette date')
    //     document.location.reload();
    //    }else{
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
              confirm(start);
              calendar.fullCalendar('refetchEvents');
            }
          })
        // }
      // }else{
      //   $('#calendar').fullCalendar('unselect');
      //   calendar.fullCalendar('refetchEvents');

      // }
    },

    editable:true,
    eventDrop:function(event)
    {
    if(event.rank == 1){
        var start = moment(event.start).format("Y-MM-DD HH:mm:ss");
        var end = moment(event.end).format("Y-MM-DD HH:mm:ss");
        var id = event.id;
        $.ajax({
          url:"/rdv_calendar_update",
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
      if(event.rank == 1){
        var start = moment(event.start).format("Y-MM-DD HH:mm:ss");
        var end = moment(event.end).format("Y-MM-DD HH:mm:ss");
        var id = event.id;
        $.ajax({
          url:"/rdv_calendar_update",
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
      if(event.rank == 1){
        
        if(confirm("Vous etes sur de supprimer de rendez-vous"))
        {
         var id = event.id;
         $.ajax({
          url:"/calendar_delete",
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
        if(confirm("vous etes sur de choiosir ce rendez-vous"))
        {
         var id = event.id;
         $.ajax({
          url:"/public_rdvs_reserver",
          type:"GET",
          data:{id_rdv:id},
          success:function()
          {
          //  calendar.fullCalendar('refetchEvents');
          alert("rendez-vous choisie");
          window.location.href = "/public_rdvs_reserver/"+id;
        },
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
  