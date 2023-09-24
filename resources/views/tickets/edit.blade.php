@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Your Ticket</h1>
  {!! Form::model($ticket, ['route' => ['update', $ticket], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}

    {!! Form::text('ticket_name' ,null, ['class'=>'form-control m-3']); !!}
    {!! Form::textarea('description' ,null, ['class'=>'form-control m-3']); !!}
    {!! Form::file('attachements', $attributes = [], ['class'=>'form-control m-5']); !!}
    <br>
    {!! Form::submit('Update',['class'=>'btn btn-success m-3 px-5']) !!}

  {!! Form::close() !!}
</div>

@endsection