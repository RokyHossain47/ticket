@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="content-wrapper">
  <div class="row">
    <div class="card">
      <div class="card-body p-5">
        <a href="{{route('ticket')}}">
          Total Ticket: 
          @if (auth()->user()->role == 1)  
            {{count(App\Models\Ticket::get())}}
          @else
            {{count(App\Models\Ticket::where('user_id', auth()->user()->id)->get())}}
          @endif
        </a>
      </div>
    </div>
  </div>
</div>

  @endsection