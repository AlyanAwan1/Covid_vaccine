<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\vaccine;
use App\Models\hospital_register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class hospitalcontroller extends Controller
{
    public function hosregister()
    {
        return view('custom_login_hospital.hospital_register');
    }
    public function registerdata(Request $input)
    {
        $table = new hospital_register();
        $table->Hospital_name = $input->name;
        $table->Hospital_address = $input->address;
        $table->Hospital_email = $input->email;
        $table->Hospital_password = bcrypt($input->password);
        $image = $input->file('image');
        $ext = rand() . "." . $image->getClientOriginalName();
        $image->move("hospitalimages/", $ext);
        $table->Hospital_Image=$ext;
        if($table->save()){
            return redirect('/loginhospital');
        }
        else{
        return redirect()->back();
    }
    }
    public function showLoginForm()
    {
        return view('custom_login_hospital.hospital_login');
    }
    public function login_post(Request $req)
    {
        $useremail = DB::table('hospital_registers')->where('Hospital_Email', $req->email)->first();
        $userpassword = DB::table('hospital_registers')->where('Hospital_Password', bcrypt($req->password))->first();
        if($useremail && bcrypt($userpassword))
        {
            session(['hospital'=>$req->email]);
            if(session('hospital'))
            {
             return view('hospitaldashboard.homehospital');
            }
            else{
             return view('custom_login_hospital.hospital_login');
            }
        }
        else{
            echo "Login Failed";
        }
    }
    public function logout()
    {
        session()->flush();
        return view('index');

    }
    public function getdata()
    {
        $records = hospital_register::get();
        return view("hospital",compact('records'));

   }
    public function fetchospital()
    {
        $fethos = hospital_register::get();
        return view("appointment",compact('fethos'));

   }
   public function insertappointment(Request $add ){
    $table = new appointment();
    $table->username= $add->username;
    $table->useremail= $add->useremail;
    $table->useraddress= $add->useraddress;
    $table->usernumber= $add->usernumber;
    $table->uservaccine= $add->uservaccine;
    $table->userhospital= $add->userhospital;
    // $table->userid = Auth::user()->id;
    $table->save();
    return redirect()->back();


}
public function insertvaccines(Request $insert){
    $table = new vaccine();
    $table->vaccine_name  = $insert->vaccinename;
    $table->hospital_id = $insert->hosid;
    $table->save;
    return redirect()->back();
    
}
}
