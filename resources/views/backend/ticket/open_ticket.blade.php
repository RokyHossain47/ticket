@extends('layouts.admin')
@section('title', 'Open Ticket')
@section('content')

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <form action="{{route('store-ticket',['action'=>'create','id'=>'all'])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="subject" class="form-control" name="subject" placeholder="Enter subject" id="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message"  class="form-control" cols="30" rows="4" placeholder="Write Message" required></textarea>
                </div>
                <button class="btn btn-success"> Send </button>
            </form>
        </div>
    </div>
</div>

@endsection