<?php

namespace App\Http\Controllers;


use App\Http\Requests\ContactHandleRequest;
use App\Models\Contact;
use App\User;
use Auth;
class ContactController extends Controller
{
    //
    public function contact_admin( $id_receiver = null)
    {
        $email = '';
        if( $id_receiver != null && Auth::user()->level === 'admin' ){
            $email  = Contact::where('id', $id_receiver)->get()[0]->sender_email;
        }
            return view('ManageUsers.contact_admin',compact('email'));

    }
    public function contact_admin_send( ContactHandleRequest $request)
    {
        $data = $request->input();
        $user = Auth::user();
        $receiver_email = "admin@test.com";
        if( Auth::user()->level === 'admin' ){
            $receiver_email = $data['receiver_email'];
        }
        Contact::create([
            'subject' => $data[ 'subject'],
            'content' => $data[ 'content'],
            'from_name' => $user->firstname .' '. $user->lastname,
            'receiver_email' => $receiver_email,
            'sender_email' => $user->email,
            'is_readed' => false,
            ]);
        session()->flash( 'contact_sending', trans( 'translate.contact_sending'));
        return redirect(url( '/inbox/all'));
    }
    public function read_msg( $id_msg)
    {
        //dd(request());
        $with_ = 0 ;
        if ( strstr( $id_msg, '_'))
        {
            $with_ = 1;
            $id_msg = str_replace('_','',$id_msg);
        }
        $message = Contact::where('id', $id_msg)->get();
        Contact::where('id', $id_msg)->update(['is_readed' => true]);
        if( $with_ === 1 )
        {
            return 'is_ok';
        }else{
            //dd( $message[0]['subject']);
            return view('ManageUsers.read_msg', compact('message'));
        }
    }
    public function  inbox( $id_msg)
    {
        $getInfoMsgs0 = $this->getMessagesAndCount('receiver_email');
        $count_msg =  $getInfoMsgs0['count'];
        $messages =   $getInfoMsgs0['msgs'];

        $getInfoMsgs = $this->getMessagesAndCount('sender_email');
        $count_msg_sent =   $getInfoMsgs['count'];
        $messagesSent =     $getInfoMsgs['msgs'];

        return view( 'ManageUsers.inbox', compact( 'id_msg', 'count_msg_sent', 'count_msg','messages','messagesSent'));
    }
    public function  inbox_msgs()
    {
        $getInfoMsgs = $this->getMessagesAndCount('receiver_email');
        return [
            'count_msg' => $getInfoMsgs['count'],
            'messages' => $getInfoMsgs['msgs']
            ];
    }

    public function  sent_msgs()
    {
        $getInfoMsgs = $this->getMessagesAndCount('sender_email');
        return [
            'count_msg_sent' =>  $getInfoMsgs['count'],
            'messagesSent'   =>  $getInfoMsgs['msgs']
            ];
    }

    private function getMessagesAndCount($typeEmail)
    {
        $user_email = Auth::user()->email;
        $messages = Contact::where( $typeEmail,$user_email)->get();
         return [
            'count' => $messages->count(),
            'msgs'  => $messages->toArray()
            ];


    }



}
