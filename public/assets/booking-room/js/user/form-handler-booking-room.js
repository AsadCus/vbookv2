
// test
$(document).ready(function () {
    var SITEURL = "{{url('/')}}";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var calendar = $('#calendar').fullCalendar({
    header:{
        left:'prev,next today,list',
        center:'title',
        right:'month,agendaWeek,agendaDay'
    },
    editable: false,
    events: function(start, end, timezone, callback){
        $.ajax({
            url : '/booking-room',
            type : 'GET',
            data : {
                m_room_id : $('#filter_room').val(),
                month : $('#calendar').fullCalendar('getDate').format()
            },
            success: function(res) {
                console.log();
                callback(res)
            }
        });
    },
    eventLimit: 5, 
    eventLimitText: "more",
    displayEventTime: true,
    selectable:true,
    selectHelper: true,
    editable: false,
    disableDragging: true,
    selectHelper: true,

});

$(document).on('change','#filter_room',function(e) {
    e.preventDefault();

    $.ajax({
        url : '/booking-room/filter-room',
        type:'POST',
        data : {
            id : $(this).val()
        },
        beforeSend: function() {
            $('.opacity').removeClass('d-none').css({'cursor':'progress'});
        },  
        success: function(res) {
            if(res.data_room == ''){
                $('.text-filter').html('')
            }else{
                $('.text-filter').html('Your currently filter : <b>'+res.data_room+'</b>')
            }
            $('.opacity').addClass('d-none').css({'cursor':'default'});;
            $('#calendar').fullCalendar('removeEvents');
            calendar.fullCalendar('renderEvents',JSON.parse(JSON.stringify(res.data)),false);
                
        },
        error : function(err) {
            console.log(err);
        }
    })
});

loadList();

function loadList(){
    $.ajax({
        url : '/booking-room/load-booking-room',
        type : 'GET',
        beforeSend:function(){
            $('.show-list-booking').html('Loading ...');
        },  
        success : function(res) {
            $('.show-list-booking').html(res.view);
            console.log(res);
        },
        error: function(res){
            console.log(res);
        }
    })
}

$(document).on('show.bs.modal', '.modal', function () {
    // run your validation... ( or shown.bs.modal )
    $('.error-text').text('');
    $('#descripsion').text('');
});

$(document).on('hide.bs.modal', '.modal', function () {   
    // loadList(); 
    $('.opacity').addClass('d-none').css({'cursor':'default'});;
});

    // create data with ajax
$(document).on('submit','#formData',function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        type: 'POST',
        data : formData,
        contentType: false,
        processData: false,
        url: $(this).attr('action'),
        beforeSend:function(){
            $('.opacity').removeClass('d-none').css({'cursor':'progress'});
            $('#btn-create').addClass("disabled").html("Processing...").attr('disabled',true);
            $(document).find('span.error-text').text('');
        },    
        complete: function(){
            $('#btn-create').removeClass("disabled").html("Save Change").attr('disabled',false);
        },
        success: function(res){

            if(res.success){
                $('.opacity').addClass('d-none').css({'cursor':'default'});;
                $('#createEvent').modal('hide');
            
                $('#calendar').fullCalendar('removeEvents', res.data.id);
               
                calendar.fullCalendar('renderEvent',
                {
                    id : res.data.id,
                    title: res.data.title,
                    start: res.data.start,
                    end: res.data.end,
                    backgroundColor : res.data.room.color_code,
                    borderColor : res.data.room.color_code,
                },false);
                
                
                Swal.fire(
                'Good job!',
                res.message,
                'success'
                )
                loadList();
            }
        },
        error(err){
            $.each(err.responseJSON,function(prefix,val) {
                $('.'+prefix+'_error').text(val[0]);
            })
            $('#btn-create').removeClass("disabled").html("Save Change").attr('disabled',false);
       
            if(err.responseJSON.success == false){
                Swal.fire(
                'Oops!',
                err.responseJSON.message,
                'error'
                )
            }
            console.log(err);
        }
    })

});

$(document).on('click','#editEvent',function(e){
    e.preventDefault();
    $('#method').val('PUT');
    $('#createEvent').modal('show');
    $('#eventTitle').text('Update Event');
    $('#formData').attr('action',$(this).data('url'));
    $('#formData')[0].reset();;
    $('.modal-body').css({'cursor':'progress'});
    $.ajax({
        type: 'GET',
        url : $(this).data('url')+'/edit',
        beforeSend: function() {
            $('#btn-create').addClass("disabled").attr('disabled',true);
            // $('.show-list-booking').html('Loading ... ');
        },
        complete: function(){
            $('#btn-create').removeClass("disabled").html("Save Change").attr('disabled',false);
            // $('.show-list-booking').html(res.view);
        },
        success: function(res){
            if(res.success){
                $('.modal-body').css({'cursor':'default'});
                $('#title').val(res.data.title);
                $('#m_room_id').val(res.data.m_room_id).change();
                $('#department').val(res.data.department);
                $('#descripsion').text(res.data.descripsion);
                
                $('#start').val(res.data.start);
                $('#end').val(res.data.end);

                $('.multiple_emails-container').remove();
                $('#email').attr('value',res.email_par);
                $('#email').multiple_emails({position: "bottom"});
                // loadList();
               
            }
            // console.log(res);
        },
        error : function(err) {
            console.log(err);
        }
    });
})

$(document).on('click','#addEvent',function(e){
    e.preventDefault();

    $('#method').val('POST');
    $('#formData')[0].reset();;
    $('#createEvent').modal('show');
    $('#formData').attr('action',$(this).data('url'));
    $('#eventTitle').text('Create Event');
    $('#email').attr('value','');
    $('.multiple_emails-email').remove();
})

function displayMessage(message) {
    $(".response").html(""+message+"");
        setInterval(function() { $(".success").fadeOut(); }, 1000);
}

$(document).on('click','.showBookingBtn',function(e){
    e.preventDefault();
    $('#showBooking').modal('show');  
    let htmlView = ` <div class="container show-loading mt-5">
                        <div class="text-center" style="font-size:30px">
                            <i class="fa fa-spinner fa-pulse"></i>
                        </div>
                    </div>`;
    $.ajax({
        url : $(this).data('url'),
        type : 'GET',
        beforeSend:function(){
            $('.show-view-booking').html(htmlView);
        },  
        success : function(res) {
            $('.show-view-booking').html(res.view); 
            
            // console.log(res);
        },
        error: function(res){
            console.log(res);
        }
    })
})

$(document).on('click','button#deleteBooking',function(e) {
    e.preventDefault();
    
    let url = $(this).data('url-delete');
    let id = $(this).data('id');
    Swal.fire({ 
        title: 'Do you want to delete this booking?',
        showDenyButton: true,
        confirmButtonText: 'Yes Deleted',
        }).then((result) => {
        if (result.isConfirmed) {
           
            $.ajax({
                    type:'DELETE',
                    url: url,
                    data:{
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success:function(response){
                    if(response.success){
                        Swal.fire(
                            'Success!',
                            response.message+'.',
                            'success'
                        )
                            $('#calendar').fullCalendar('removeEvents', id);
                            loadList(); 
                        }
                    },
                    error:function(err){
                        console.log(err);
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: err.responseJSON.message+'.',
                        })
                    }
            });
        }
    })
});


// 2
// $(document).on('click','',function(){
//     var get_month= $('#calendar').fullCalendar('getDate');
//     alert(get_month.format());
// })


});