<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        if(auth()->user()->role == 1) {
            $page_data['tickets'] = Ticket::get();
        }else{
            $page_data['tickets'] = Ticket::where('user_id', auth()->user()->id)->get();
        }
        return view('backend/ticket/index', $page_data);
    }

    public function open_ticket(){
        if(auth()->user()->role == 1){
            return redirect()->back();
        }
        return view('backend/ticket/open_ticket');
    }
    public function store(Request $request, $action = "", $id = "") {
        $validated = $request->validate([
            'subject' => 'required|max:125',
            'message' => 'required|max:65500',
        ]);
        $data['subject'] = $request->subject;
        $data['message'] = $request->message;
        $data['user_id'] = auth()->user()->id;
        $data['updated_at'] = Carbon::now();
        if($action == 'create'){
            $data['created_at'] = Carbon::now();
            $insert = Ticket::insert($data);
            $message = 'Created Successfully';
        }else{
            $insert = Ticket::where('id', $id)->update($data);
            $message = 'Updated Successfully';
        }
        if($insert) {
            return redirect('ticket')->with('success', $message);
        }else{
            return redirect()->back()->with('error', 'Something Wrong');
        }
    }

    public function edit($id) {
        if(auth()->user()->role == 1){
            return redirect()->back();
        }
        $page_data['ticket'] = Ticket::where('id', $id)->first();
        return view('backend/ticket/edit_ticket', $page_data);
    }

    public function delete($id) {
        $delete = Ticket::where('id', $id)->delete();
        if($delete) {
            return redirect()->back()->with('error', 'Deleted Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong');
        }
    }

    public function view($id) {
        $page_data['ticket'] = Ticket::where('id', $id)->first();
        $page_data['messages'] = Message::where('ticket_id',$id)->get();
        return view('backend/ticket/view', $page_data);
    }

    public function send_message(Request $request, $ticket_id) {
      
        $message = Message::create([
            'ticket_id' => $ticket_id,
            'sender_id' => auth()->user()->id,
            'message' => $request->message,
        ]);
        
        return response()->json(['status' => true]);
    }

}
