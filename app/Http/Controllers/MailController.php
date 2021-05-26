<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {

   public function html_email(Request $request, $title, $content, $name) {
      request()->validate([
         'email' => 'required',
      ]);
      $emailTo = $request->email;
      $data = array('name'=>$name, 'title'=>$title, 'content'=>$content);
      Mail::send('mail', $data, function($message)use($emailTo) {
         $message->to($emailTo, 'PINNED');
         $message->subject('Shared Task');
         $message->from('daryljohntadeo359@gmail.com','PINNED Admin');
      });
      return redirect('/tasks');
   }

}