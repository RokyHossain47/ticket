@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        @if (auth()->user()->role == 1)
                        <th>User Name</th>
                        @endif
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if(count($tickets))
                <tbody> 
                    @foreach ($tickets as $key => $ticket)    
                    <tr>
                        <td>{{$key+1}}</td>
                        @if (auth()->user()->role == 1)
                        <td>{{App\Models\User::where('id', $ticket->user_id)->first()->name}}</td>
                        @endif
                        <td><a href="{{route('view-ticket',['id'=>$ticket->id])}}">{{$ticket->subject}}</a></td>
                        <td>{{$ticket->message}}</td>
                        <td>
                            <a href="{{route('edit-ticket',['id'=>$ticket->id])}}" class="btn btn-success"> Edit </a>
                            <a href="{{route('delete-ticket',['id'=>$ticket->id])}}" class="btn btn-danger"> Delete </a>
                        </td>
                    </tr>                    
                    @endforeach
                </tbody>
                @else
                    <p>No Data Found</p>               
                @endif
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#example');
</script>

@endsection