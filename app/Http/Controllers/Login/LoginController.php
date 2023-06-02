<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Login\RegisterRequest;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function getLogin(){
        return view('login.login');
    }

    public function getRegister(){
        return view('login.register');
    }

    public function postRegister(RegisterRequest $request){

        $data = $request->except('_token', 'password_confirmation');
        $data['fullname'] = '@user' .mt_rand(100000, 999999999);
        $data['password'] = bcrypt($request->password);
        $data['created_at'] = new \DateTime();
        $data['uuid'] = Str::uuid();
        $data['status_user'] = 1;
        $data['level'] = 3;
        $result = User::insert($data);;
        if ($result) {
            Mail::to($request->email)->send(new NotifyMail($data));
            return  redirect()
            ->route('getLogin')->with('success','Đã gửi mail thành công,vui lòng xác nhận');
        }
    }

    public function verify($uuid)
    {
        $data =  User::where('uuid', $uuid)
            ->first();
        if ($data->email_verified_at == null) {
            User::where('uuid', $uuid)
                ->update(['email_verified_at' => new \DateTime()]);
            return redirect()
                ->route('getLogin')
                ->with('success', 'Email verification successful');
        } else {
            return redirect()->route('website.index');
        }
    }

}
