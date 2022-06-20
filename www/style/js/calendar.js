$(document).ready(function() {
  var rank = [];

  var activeAvailableMeetings = false

  $('#meeting_inputs').hide();
  $('.new_meeting_calendar').hide();
  $( "<div class='main_meeting_calendar col-6 ' id='calendar'></div>" ).prependTo( ".calendar_article1" );
  loadcalendar($('#calendar'))

  $('.cta-button.cta-button-a.cta-button--submit.cta-button--submit--add').on('click',function(){
    activeAvailableMeetings = true
    $('.calendar_article2').show()
    $( ".calendar_article1" ).hide();
    $( "<div class='main_meeting_calendar col-6  ' id='calendar2'></div>" ).prependTo( ".calendar_article2" );
    setTimeout(() => {
      loadcalendar($('#calendar2'))
    }, 100);
  })



  $('.material-icons-round').on('click',function(){
    activeAvailableMeetings = false
    if($('#calendar')){
      $('#calendar').hide()
    }
    $('#calendar2').remove()
    $('.calendar_article2').hide()
    $( ".calendar_article1" ).css('display','block');
    $( "<div class='main_meeting_calendar col-6 ' id='calendar'></div>" ).prependTo( ".calendar_article1" )
    loadcalendar($('#calendar'))
  })


  function showMeetingCalendarMeetings() {
    activeAvailableMeetings = true
    $('.calendar_article2').show()
    $( ".calendar_article1" ).hide();
    $( "<div class='main_meeting_calendar  col-6 ' id='calendar2'></div>" ).prependTo( ".calendar_article2" );
    setTimeout(() => {
      loadcalendar($('#calendar2'))
    }, 100);
  }

  //il faut supprimer le // a:not([href]) {pointer-events:none// du css pour pouvoir manipuler le calandrier 

function loadcalendar(id){
// $('#calendar')
  const calendar = id.fullCalendar({   
    lang: 'fr',
    editable:true,
    defaultView: 'basicWeek',
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay',
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
      }else if(location.pathname == '/meetings' && !activeAvailableMeetings){
        $.ajax({
          method: 'POST',
          url:"/loadmeetings",
          color: '#000',
          dataType: 'json',
          success: function(events) {
            callback(events);
            events.map((e)=>{
              rank.push(e.rank);

            })
          }
        });
      }else if(location.pathname == '/meetings' && activeAvailableMeetings ){
         $.ajax({
          method: 'POST',
          url:"/loadavailablemeetings",
          color: '#000',
          dataType: 'json',
          success: function(events) {
            callback(events);
            events.map((e)=>{
              rank.push(e.rank);
            })
          }
        });
      }


    },  

    // INSERT EVENTS /////////////////////////////////////////////
    initialView: 'dayGridWeek',
    minTime: '09:00:00', 
    maxTime: '21:00:00', 
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay,event)
    {
      if(location.pathname == '/slots' && activeAvailableMeetings ){
        if(start.isBefore(moment())) {
          id.fullCalendar('unselect');
          alertMessage('Impossible de séléctionnez cette date','warning')
          // document.location.reload();
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
                alertMessage('insertion reussie');
                calendar.fullCalendar('refetchEvents');
                // document.location.reload();
              }
            })
          }
      }else {
        id.fullCalendar('unselect');
      console.log(activeAvailableMeetings)

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
          alertMessage("Event Updated");
          }
        });
      }else{
        calendar.fullCalendar('refetchEvents');
      }
    },

    //enlever les slos en rouges dans meetings
    //

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
          alertMessage('Event Update');
          }
        })
      }else{
        calendar.fullCalendar('refetchEvents');
      }
    },

    // DELETE EVENTS /////////////////////////////////////////////

    eventClick:function(event)
    {
      if(event.rank == 'admin' && location.pathname == '/slots' && activeAvailableMeetings   ){
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
           alertMessage("Event Removed");
          }
         })
        }
      }else if(activeAvailableMeetings && location.pathname == '/meetings'){
          var btn = '<button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-form-meeting">New meeting </button>';
          getAnimate($(btn));
          
          $(document).on('click','#cta-button-close-container-new-form-meeting',function(e){
            showMeetingCalendarMeetings()
          })
        
          $('.start_end_title').text(event.start._i + '  -  ' + event.end._i);
          
          $(document).on('click','.cta-button-compose-rdv',function(e){
             var id = event.id;
             $.ajax({
              url:"/meeting/compose",
              type:"POST",
              data:{
                id:id,
                title: $('[name="title"]').val(),
                location: $('[name="location"]').val(),
                description: $('#description').val(),
              },
              success:function(answer)
              {
                if (answer.includes('<section id="back-office-container">')){
                  $($('main')[0]).html(answer);
                  alertMessage("Chosen Meeting");
                }else{
                  $('#form-new-meeting').html(answer);
              }
              },
            })
          })
      }
    },
    // EMPECHER DE SELECTIONNER UNE DATE EXISTANTE
    selectOverlap: function(event) {
      return false
    },
  });
}
});
  
