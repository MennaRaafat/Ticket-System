@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
        <div class="col-md-8">
        @foreach( $tickets as $ticket )
            <div class="card m-5">
                <div class="card-header p-3"><h2>{{$ticket -> ticket_name}}</h2></div>
                <div class="card-body p-3">
                    {!! Form::open(["route" => ['view', $ticket ], "method" => "get"]) !!}
                    {!! Form::submit('View Ticket Detail',['class'=>'btn btn-primary m-3 px-5']) !!}
                    {!! Form::close() !!}

                </div>
                </div>       
               @endforeach

        </div>
    </div>
</div>

@endsection
