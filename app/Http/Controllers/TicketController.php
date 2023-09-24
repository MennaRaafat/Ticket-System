<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Notifications\TicketNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TicketController extends Controller
{

    public function index(){
        $user = Auth::user();
        $tickets = $user->isAdmin() ? Ticket::all(): Ticket::where('user_id', $user->id)->get();
        return view('tickets.index' , ['tickets' => $tickets]);
    }

    public function create(){
        return view('tickets.create');
    }

    public function add(Request $request ){

    $ticket = Ticket::create([
     'ticket_name' => $request -> ticket_name,
     'description' => $request -> description,
     'user_id' => Auth::user()->id
    ]);

    if($request -> file('attachements') ){
        $ext = $request ->attachements->extension();
        $content=file_get_contents($request -> attachements);
        $filename = Str::random(25);
        $file_path = "attachments/$filename.$ext";
        Storage::disk('public') -> put( $file_path , $content);
        $ticket -> update(['attachements' => $file_path]);
    }
      return redirect('/tickets/view');
    }

    public function view($id){
        $ticket=Ticket::find($id);
        return view('tickets.singleTicket' , ['ticket' => $ticket]);
    }


    public function edit(Request $request , Ticket $ticket){
        $ticket_id = $request->id;
        $ticket= Ticket::find($ticket_id);
        $ticket->update(['status' => $request -> status]);
        if($request -> has('status')){
            $ticket -> user -> notify(new TicketNotification($ticket));
        }
        return redirect('/tickets/view');
    }

    public function editTicket($id){
      $ticket = Ticket::find($id);
      return view ('tickets.edit' , ['ticket' =>$ticket]);
    }

    public function update(Request $request){
        $ticket_id = $request->id;
        $ticket = Ticket::find($ticket_id);
        $attachement = $request->file('attachements');
        $oldAttach=$ticket->attachements;
        Storage::delete('public/' . $oldAttach);
        $ext = $attachement->extension();
        $content=file_get_contents($attachement);
        $filename = Str::random(25);
        $file_path = "attachments/$filename.$ext";
        Storage::disk('public') -> put( $file_path , $content);
        $ticket -> update(['attachements' => $file_path]);
        $ticket ->update([
           'ticket_name' => $request -> ticket_name,
           'description' => $request -> description
        ]);
        return redirect('/tickets/view');
    }

    public function destroy(Request $request){
        $ticket_id = $request->id;
        $ticket=Ticket::find($ticket_id);
        $oldAttach=$ticket->attachements;
        Storage::delete('public/' . $oldAttach);
        $ticket->delete();
        return redirect('/tickets/view');
    }

    public function download(Request $request)
    {
        $ticket_id = $request->id;
        $ticket = Ticket::find($ticket_id);
        $attachment = $ticket->attachements;
        return Response::download(storage_path('app/public/' . $attachment));
    }
    
    
}
