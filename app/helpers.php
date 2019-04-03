<?php

if (!function_exists('messages_handle')) {
    function messages_handle()
    {
        $user_email = Auth::user()->email;
        $messages = App\Models\Contact::where( 'receiver_email',$user_email)->where( 'is_readed', false)->get();
        return [
            'count_unread' => $messages->count(),
            'messages' => $messages->toArray()
            ];
    }
}

