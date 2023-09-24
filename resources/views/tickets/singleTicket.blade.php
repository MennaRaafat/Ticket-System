@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card m-5">
                <div class="card-header p-3"><h2>{{$ticket -> ticket_name}}</h2></div>

                <div class="card-body p-3">
                        <div>
                        <h3>{{ $ticket ->description}}</h3>
                        <div class="d-flex my-4">
                        <h5 class="mx-3">Status: {{ $ticket ->status}}</h5>
                        <h5 class="mx-5"><a href="{{'/storage/'.$ticket->attachements}}">View Attachment</a></h5>
                        {!! Form::open(['route' =>['download' , $ticket] , 'method' => 'post']) !!}
                        <div style="margin-top:-4%">{!! Form::submit('Download Attachment',['class'=>'btn btn  px-5']) !!}</div>
                        {!! Form::close() !!}

                        <!-- <img src="{{ asset('storage/' . $ticket->attachments) }}"> -->
                        <!-- <h5><a href="{{ Storage::url($ticket->attachements) }}">View Attachment</a></h5> -->
                        </div>
                        @if(Auth::user()->isAdmin())
                        <div class="d-flex">
                        {!! Form::model($ticket,['route' =>['status' , $ticket] , 'method' => 'patch']) !!}
                        {!! Form::hidden('status' , 'Accept') !!}
                        {!! Form::submit('Accept',['class'=>'btn btn-success m-3 px-5']) !!}
                        {!! Form::close() !!}


                        {!! Form::model($ticket,['route' =>['status' , $ticket] , 'method' => 'patch']) !!}
                        {!! Form::hidden('status' , 'Reject') !!}
                        {!! Form::submit('Reject',['class'=>'btn btn-danger m-3 px-5']) !!}
                        {!! Form::close() !!}
                        </div>
                        @else
                        <div class="d-flex">
                        @if($ticket->status == 'Open')
                        {!! Form::open(['route' =>['editTicket' , $ticket] , 'method' => 'get']) !!}
                        {!! Form::submit('Edit',['class'=>'btn btn-success m-3 px-5']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' =>['delete' , $ticket] , 'method' => 'delete']) !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger m-3 px-5']) !!}
                        {!! Form::close() !!}
                        @endif
                        </div>
                        @endif
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
