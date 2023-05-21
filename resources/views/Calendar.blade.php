@extends('app.app')
@section('title','Dashboard')

@section('content')

<!--store modal -->

<div class="modal fade" id="calendarModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Title<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="title">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Description</label>
            <textarea class="form-control" placeholder="Description (optional)" id="description"></textarea>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Link</label>
            <input type="text" placeholder="link (optional)"  class="form-control" id="link">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Color</label>
            <input type="color" class="form-control" id="color">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary insertEvent">Insert Event</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->

<!--update modal -->

<div class="modal fade" id="updatecalendarModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Title<sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" id="update_title">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Description</label>
            <textarea class="form-control" placeholder="Description (optional)" id="update_description"></textarea>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Link</label>
            <input type="text" class="form-control" placeholder="link (optional)" id="update_link">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Color</label>
            <input type="color" class="form-control" id="update_color">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Start Date</label>
            <br><small> MM/DD/YYYY , HH:MM:ss</small>
            <input type="datetime-local" class="form-control" id="start">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">End Date</label>
            <br><small> MM/DD/YYYY , HH:MM:ss</small>
            <input type="datetime-local" class="form-control" id="end">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info gotoLink">Goto Link</button>       
        <button type="button" class="btn btn-danger deleteEvent" data-bs-dismiss="modal" title="Click to delete this Event">Delete</button>
        <button type="button" class="btn btn-primary updateEvent">Update Event</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->


<!--general user  modal -->

<div class="modal fade general_model" id="generalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Event Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Title: <span class="Gtitle"></span></label>           
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Description</label>
            <p class="Gdescription m-1"></p>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Link</label>
            <p class="Glink m-1"></p>
          </div>
          
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Start Date: <span class="Gstart_date"></span></label>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">End Date: <span class="Gend_date"></span></label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info gotoLink">Goto Link</button>  
      </div>
    </div>
  </div>
</div>
<!-- end general user -->



<div class="container-fluid" style="margin-top: 5rem !important;">
    <div class="row justify-content-center align-content-center d-flex my-5">

        <div class="col-md-11">
            <div id="calendar"></div>
        </div>
    </div>
</div>


<script>
$('.gotoLink').unbind().on('click',function(){
    window.open($('#update_link').val());
})
const user=@json(Auth::user());
console.log(user)
calendar_func()
function calendar_func(){
    var booking=@json($calendar);
    console.log(booking)

    if(user.user_type== 'Admin'){
        var edit=true;
    }else{
      var edit=false;
    }
    var calendar = $('#calendar').fullCalendar({     
    editable:edit,
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    events: booking,
    selectable:true,
    selectHelper:true,
    select: function(start,end,allDays){
        if(user.user_type== 'Admin'){
        $('#calendarModel').modal('show')
        }
        else{
          Swal.fire({
            title: 'Warning!',
            text: "Only admin can add event",
            icon: 'error',
            confirmButtonText: 'Okey'
          })
        }
        $('.insertEvent').unbind().on('click',function(){
           
            var title=$('#title').val()
            var color=$('#color').val()
            var description=$('#description').val()
            var link=$('#link').val()
            
            var start_date=moment(start).format('YYYY-MM-DD HH:mm:ss')
            var end_date=moment(end).format('YYYY-MM-DD HH:mm:ss')
            if($('#title').val().length !== 0){
                $('.insertEvent').html('<div class="px-2 text-center"><div class="text-center spinner spinner-border spinner-border-sm"></div></div>')
                axios.post('/upload_event',{title,description,link,color,start_date,end_date})
                .then(function(response){
                    if(response.status == 200){
                        Swal.fire({
                            title: 'Success!',
                            text: 'Event added',
                            icon: 'success',
                            confirmButtonText: 'Okey'
                        })
                        $('#title').val('')
                        $('#calendarModel').modal('hide')
                        $('#calendar').fullCalendar('renderEvent',{
                            'title':response.data.calendar.title,
                            'description':response.data.calendar.description,
                            'link':response.data.calendar.link,
                            'color':response.data.calendar.color,
                            'start':response.data.calendar.start,
                            'end':response.data.calendar.end,
                        });
                        $('.insertEvent').html('Insert Event')   
                    }else{   
                        $('#title').val('')
                        $('.insertEvent').html('Insert Event')               
                        Swal.fire({
                            title: 'Warning!',
                            text: response.data.toString(),
                            icon: 'error',
                            confirmButtonText: 'Okey'
                        })
                    }
                })
                .catch(function(){
                    $('.insertEvent').html('Insert Event') 
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Sonthimg wrong',
                        icon: 'error',
                        confirmButtonText: 'Okey'
                    })
                })
            }
            else{
                Swal.fire({
                    title: 'Empty!',
                    text: 'Title field is required',
                    icon: 'error',
                    confirmButtonText: 'Okey'
                })
            }
        })
        
    },
    eventDrop: function(event){

        var id=event.id
        var title=event.title
        var description=event.description
        var link=event.link
        var color=event.color
        var start_date=moment(event.start).format('YYYY-MM-DD  HH:mm:ss')
        var end_date=moment(event.end).format('YYYY-MM-DD  HH:mm:ss')
       console.log(event)
        axios
        .post('update_event',{id,title,description,link,color,start_date,end_date})
        .then(function(response){              
            if(response.status == 200){ 
                Swal.fire({
                    title: 'Success!',
                    text: 'Event Changed',
                    icon: 'success',
                    confirmButtonText: 'Okey'
                })
            }
        })
        .catch(function(){
            Swal.fire({
                title: 'Failed!',
                text: 'Sonthimg wrong',
                icon: 'error',
                confirmButtonText: 'Okey'
            })
        })  
    },
    eventClick:function(event){
        
        var id=event.id
        var title_event=event.title
        var description=event.description
        var link=event.link
        var color_event=event.color
        var start_date_event=event._start._i
        var end_date_event=event._end?._i
        $('#update_title').val(title_event)
        $('#update_description').val(description)
        $('#update_link').val(link)
        $('#update_color').val(color_event)
        $('#start').val(start_date_event)
        $('#end').val(end_date_event)

        if(user.user_type== 'Admin'){
          $('#updatecalendarModel').modal('show')
        }
        else{
          console.log(title_event)
          $('.Gtitle').html(title_event)
        $('.Gdescription').html(description)
        $('.Glink').html(link)
        
        $('.Gstart_date').html(start_date_event)
        $('.Gend_date').html(end_date_event)

        $('#generalUser').modal('show')
        }
        $('.updateEvent').unbind().on('click',function(){
            var title=$('#update_title').val()
            var color=$('#update_color').val()
            var description=$('#update_description').val()
            var link=$('#update_link').val()
            var start_date=$('#start').val()
            var end_date=$('#end').val()  
            
            
            
            $('.updateEvent').html('<div class="px-2 text-center"><div class="text-center spinner spinner-border spinner-border-sm"></div></div>')                
            axios
            .post('/update_event',{id,description,link,color,title,start_date,end_date})
            .then(function(response){              
                if(response.status == 200){
                    $('.updateEvent').html('Update Event')
                    $('#updatecalendarModel').modal('hide')
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event Title Changed',
                        icon: 'success',
                        confirmButtonText: 'Okey'
                    })                            
                    event.title = response.data.title;
                    event.color = response.data.color;
                    event.description = response.data.description;
                    event.link = response.data.link;
                    event.start = response.data.start;
                    event.end = response.data.end;
                    $('#calendar').fullCalendar('updateEvent', event);
                    
                }else{
                    $('.updateEvent').html('Update Event')
                    Swal.fire({
                    title: 'Failed!',
                    text: response.data.toString(),
                    icon: 'error',
                    confirmButtonText: 'Okey'
                })
                }
            })
            .catch(function(){
                $('.updateEvent').html('Update Event')
                Swal.fire({
                    title: 'Failed!',
                    text: 'Sonthimg wrong',
                    icon: 'error',
                    confirmButtonText: 'Okey'
                })
            })
        })

        $('.deleteEvent').unbind().on('click',function(){
            axios
            .get(`delete/${id}`)
            .then(function(response){
                if(response.data == 1){
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event Deleted',
                        icon: 'success',
                        confirmButtonText: 'Okey'
                    })
                    $('#calendar').fullCalendar( 'removeEvents', [ event.id ] )
                }else{
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Somthing wrong',
                        icon: 'warning',
                        confirmButtonText: 'Okey'
                    })
                }
            })
            .catch(function(){
                Swal.fire({
                    title: 'Failed!',
                    text: 'Somthing wrong',
                    icon: 'error',
                    confirmButtonText: 'Okey'
                })
            })
        })
    }, 
    eventResize: function(event) {
     
      var id=event.id
        var title=event.title
        var description=event.description
        var link=event.link
        var color=event.color
        var start_date=moment(event.start).format('YYYY-MM-DD  HH:mm:ss')
        var end_date=moment(event.end).format('YYYY-MM-DD  HH:mm:ss')
       console.log(event)
        axios
        .post('update_event',{id,title,description,link,color,start_date,end_date})
        .then(function(response){              
            if(response.status == 200){ 
                Swal.fire({
                    title: 'Success!',
                    text: 'Event Changed',
                    icon: 'success',
                    confirmButtonText: 'Okey'
                })
            }
        })
        .catch(function(){
            Swal.fire({
                title: 'Failed!',
                text: 'Sonthimg wrong',
                icon: 'error',
                confirmButtonText: 'Okey'
            })
        })  
  }
})

}

</script>

@endsection