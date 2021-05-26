<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function basic_email() {
      $data = array('name'=>"Name Goes Here");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('daryltadss21@gmail.com', 'Todo Web Application')->subject
            ('Todo Task Shared');
         $message->from('daryljohntadeo359@gmail.com','Todo Admin');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
   
   public function html_email($title, $content) {
      $data = array('name'=>"Name Here", 'title'=>$title, 'content'=>$content);
      Mail::send('mail', $data, function($message) {
         $message->to('daryltadss21@gmail.com', 'Todo Web Application')->subject
            ('Todo Task Shared');
         $message->from('daryljohntadeo359@gmail.com','Todo Admin');
      });
      echo "HTML Email Sent. Check your inbox.";
   }

   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('daryltadss21@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}