<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;
use Illuminate\Support\Facades\DB;
use App\Models\appointment;
class admincontroller extends Controller
{
    public function contact(Request $contactdata ){
        $table = new contact();
        $table->name= $contactdata->name;
        $table->email= $contactdata->email;
        $table->address= $contactdata->address;
        $table->phone_no= $contactdata->number;
        $table->message= $contactdata->message;
        $table->save();
        return redirect()->back();

    }
    public function usercontactrecords()
    {
        $userrec = contact::get();
        return view("admindashboard.usercontact",compact('userrec'));

   }
   public function getvaccines(Request $req)
   {
    $hosid =  $req->post('hospitalid');
    $vaccine = DB::table('vaccines')->where('hospital_id',$hosid)->get();
    foreach($vaccine as $v)
    {
        echo '<option value='.$v->vaccine_name.'>'.$v->vaccine_name.'</option>';
    }


   }

}
