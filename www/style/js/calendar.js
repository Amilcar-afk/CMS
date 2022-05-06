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
    select: function(start, end, allDay)
    {
      var start = moment(start).format("Y-MM-DD HH:mm:ss");
      var end = moment(end).format("Y-MM-DD HH:mm:ss");
    $.ajax({
      url:"/rdv_calendar_insert",
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
    },

    // UPDATE EVENTS /////////////////////////////////////////////

    // eventDrop:function(event)
    // {
    //  var start = moment(event.start).format("Y-MM-DD HH:mm:ss");
    //  var end = moment(event.end).format("Y-MM-DD HH:mm:ss");
    //  var id = event.id;
    //  $.ajax({
    //   url:"/rdv_calendar_update",
    //   type:"POST",
    //   data:{start:start, end:end, id:id},
    //   success:function()
    //   {
    //    calendar.fullCalendar('refetchEvents');
    //    alert("Event Updated");
    //   }
    //  });
    // },

    editable:true,
    eventResize:function(event)
    {
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
    },

    // DELETE EVENTS /////////////////////////////////////////////

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
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
    },
    


  });
});
  