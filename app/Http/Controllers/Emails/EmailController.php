<?php

namespace App\Http\Controllers\Emails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Models\Unlocked;
class EmailController extends Controller
{
    //
    public function sendEmailRegistration()
    {
        //dd(config( 'app.MAIL_USERNAME'));
        $email = request('email') ;
        $register_token =  md5($email . '&Key=appCar_Rent');
        $link = '<a href="http://localhost/CarRental/public/register/'. $register_token.'" target="_blank" >'. trans('translate.Unlocked_App_Email_here').'</a>';
        $title = trans('translate.Unlocked_App_Email_title');
        $content =  '<p>'.trans('translate.Unlocked_App_Email_content', [ 'link_register' => $link]). '</p>';


        $email_exists = Unlocked::where('email', $email)->get();
        if( $email_exists->count() !== 0 )
        {
            $number_attempts = $email_exists[0]->number_attempts;
            if( $number_attempts >= 3)
            {
                session()->flash( 'change_email', trans( 'translate.change_email'));
                return redirect(url( 'unlocked'));

            }else{
                $number_attempts =  $number_attempts+1;
                Mail::send('emails.sendEmailRegistration', ['title' => $title, 'content' => $content], function ($message) {

                    $message->to(request('email'));
                });
                if (Mail::failures())
                {
                    session()->flash( 'again', trans( 'translate.again'));
                    return redirect(url( 'unlocked'));

                }else{
                    Unlocked::where('email', $email)->update([
                        'number_attempts' => $number_attempts,
                    ]);
                    session()->flash( 'request_send', trans( 'translate.request_send'));
                    return redirect(url('login'));
                }
            }

        }else{
            //dd( $content);
            Mail::send('emails.sendEmailRegistration', ['title' => $title, 'content' => $content], function ($message) {

                $message->to(request('email'));
            });
            if (Mail::failures()) {
                session()->flash('again', trans('translate.again'));
                return redirect(url('unlocked'));

                } else {
                Unlocked::create([
                    'email' => $email,
                    'number_attempts' => 1,
                    'register_token' => $register_token
                ]);

                session()->flash('request_send', trans('translate.request_send'));
                return redirect(url('login'));
            }
        }

    }

}
