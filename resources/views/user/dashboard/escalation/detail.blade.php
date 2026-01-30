@extends('user.dashboard.layout.master')
@section('user-contant')

<style>
    .badge-red {
        background-color: #f44336;
        color: white;
    }

    .badge-green {
        background-color: #4caf50;
        color: white;
    }

    .chat-box {
    max-height: 400px;
    overflow-y: auto;
    }

    .chat-input {
        position: sticky;
        bottom: 0;
    }

    .chat-message {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
}

    .chat-message img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .chat-message .message-content {
        display: inline-block;
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 10px;
    }

    .support-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .support-header a {
        text-decoration: none;
    }

    .ticket-id {
        font-weight: bold;
    }

    .status-tag {
        display: inline-block;
        margin-left: 10px;
    }

    .last-update {
        font-size: 12px;
        color: gray;
    }

    .chat-input input {
        border-radius: 20px;
        padding-left: 20px;
    }

    .chat-input button {
        background: none;
        border: none;
        font-size: 20px;
    }

    .chat-input button img {
        width: 30px;
        height: 30px;
    }

    .message-avatar {
    margin-right: 10px;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    background-color: #007bff; /* Customize color if needed */
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 12px;
    font-weight: bold;
}

.chat-message.text-right .avatar-circle {
    background-color: #28a745; /* Green for Support Team */
    width: 50px;
    height: 50px;
}

.message-content {
    background-color: #f1f1f1;
    padding: 10px;
    border-radius: 5px;
    max-width: 70%;
}

.chat-message.text-right .message-content {
    background-color: #007bff;
    color: white;
}

.text-muted {
    font-size: 0.9rem;
}

</style>
<div class="loader"></div>
<div class="main-content supreme-container">
   <section class="section" style="margin-top:-34px;">
      <div class="section-body">
         <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="card">
                  <div class="card-header">
                     <h4>Support - Ticket Details</h4>
                  </div>
                  <div class="card-body">
                     {{-- New  --}}
                     <div class="container mt-4">
                        <!-- Header -->
                        <div class="support-header mb-4">
                           <div>
                              <a href="{{route('user.escalations')}}" class="btn btn-primary mr-1 go_forbtn float-right" style="color:white;border-radius: 5px;padding: 0.3rem 0.8rem !important;" data-toggle="tooltip" data-placement="top" title="Go Back" type="submit" ><i class="fa-sharp fa fa-arrow-left"></i></a>
                           </div>
                           <div>
                              <span class="ticket-id"><b>#{{$ticketDetails->ticket_id ?? ''}}</b></span>
                              <div class="status-tag">
                                @if($ticketDetails->status == '0')
                                 <span class="badge badge-red">Open</span>
                                 @else
                                 <span class="badge badge-green">Closed</span>
                                 @endif
                                 <span class="last-update">Last Update: {{ \Carbon\Carbon::parse($ticketDetails->updated_at)->format('d-m-Y H:i:s') }}</span>
                              </div>
                           </div>
                           <div>
                            @if($ticketDetails->status == '0')
                              
                              <button class="btn btn-outline-success" id="resolved" data-ticket-id="{{ $ticketDetails->ticket_id }}">Mark as Resolved</button>

                              @else
                              <button class="btn btn-outline-success" id="resolved" disabled>Mark as Resolved</button>
                            @endif
                           </div>
                        </div>
                        <!-- Conversation Section -->
                        <div class="card">
                            <div class="card-body">
                                <div class="chat-box">
                                    @foreach($ticketHistory as $history)
                                        <!-- Client Message (left) -->
                                        @if($history->usertype == 'client')
                                        <div class="chat-message d-flex align-items-start">
                                            <div class="message-avatar">
                                                <div class="avatar-circle">You</div>
                                            </div>
                                            <div class="message-content bg-light">
                                                {{ $history->comment }}
                                            </div>
                                            <small class="text-muted d-block mt-2 ml-2">{{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y H:i:s') }}</small>
                                        </div>
                                        @endif
                            
                                        <!-- Admin Message (right) -->
                                        @if($history->usertype == 'admin')
                                        <div class="chat-message d-flex align-items-start justify-content-end text-right">
                                            <div class="message-content bg-primary text-white">
                                                {{ $history->comment }}
                                            </div>
                                            <div class="message-avatar ml-2">
                                                <div class="avatar-circle">Rappidx</div>
                                            </div>
                                            <small class="text-muted d-block mt-2 ml-2">{{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y H:i:s') }}</small>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            
                            
                           <!-- Chat Input -->
                           <form method="post" id = "addForm">
                            @csrf
                           <div class="card-footer chat-input">
                              <div class="input-group">
                                <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticketDetails->ticket_id}}">
                                 <input type="text" name="comment" id="comment" class="form-control" placeholder="Enter your message" required>
                                 <div class="input-group-append">
                                    <input type="submit" name="submit" class="btn btn-primary form-control">
                                    {{-- <button class="btn btn-primary" id="sendButton">Add Your Comment</button> --}}
                                 </div>
                              </div>
                           </div>
                           </form>

                        </div>
                     </div>
                     {{-- New --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
            <script type="text/javascript">
    
    $(document).ready(function() {
            var _ = $('body');
            var createRecord = 'Are you sure you want to add the comment?';
            
            
            $('body').on('submit', '#addForm', function(e) {
                
                
                e.preventDefault();
                var current = $(this);
                if (confirm(createRecord)) {
                    var data = current.serialize();
                    Swal.fire({
                        title: "Please wait...",
                        html: "Processing..."
                    })
                    Swal.showLoading();
                    $.ajax({
                        url: "{{route('user.save_history')}}",
                        dataType : "json",
                        type: "post",
                        data : data,
                        success : function(response) {
                            
                            $('.submit').removeAttr('disabled');
                            
                            if(response.status == 'success') {
                                
                                
                                $('#subject').val('');
                                //$('#escalation_date').val('');
                                $('#escalation_message').val('');
                                
                                Swal.fire({
                                             icon: 'success',
                                             title: 'Success!',
                                             text: response.message,
                                         });
                                         window.location.reload();
                            }  else if(response.status == 'error') {
                              Swal.fire({
                                             icon: 'error',
                                             title: 'Error!',
                                             text: response.message,
                                         });
                            }
                        },
                    });
                    return false;
                }
                return false;
            });

            $('#resolved').on('click', function() {
            var ticketId = $(this).data('ticket-id');
            $.ajax({
                url: '{{ route('user.mark_resolved') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ticket_id: ticketId
                },
                success: function(response) {
                    if(response.status == 'success') {
                                
                                
                               Swal.fire({
                                             icon: 'success',
                                             
                                             text: response.message,
                                         });
                                         window.location.reload();
                            }  else if(response.status == 'error') {
                              Swal.fire({
                                             icon: 'error',
                                             title: 'Error!',
                                             text: response.message,
                                         });
                            }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });
      });

      var today = new Date().toISOString().split('T')[0];
        $('#escalation_date').attr('max', today);
        

  </script>


@endsection