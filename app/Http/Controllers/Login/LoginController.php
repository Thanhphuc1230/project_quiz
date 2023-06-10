<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Login\RegisterRequest;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    public function getLogin(){
        return view('login.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->email_verified_at != null) {
                if (Auth::attempt($login)) {
                    if (Auth::user()->level == 1 || Auth::user()->level == 2) {
                        $request->session()->regenerate();
                        return redirect()
                            ->route('admin.categories.index')
                            ->with('success', 'Login with admin account success.');
                    } else {
                        return redirect()
                            ->route('website.index')
                            ->with('success', 'Đăng nhập thành công ');
                    }
                } else {
                    return back()->with([
                        'error' => 'Email or password wrong, Please enter again',
                    ]);
                }
            } else {
                return back()->with([
                    'error' => 'Please confirm your email',
                ]);
            }
        } else {
            return back()->with([
                'error' => 'This account does not exit',
            ]);
        }
    }

    public function getRegister(){
        return view('login.register');
    }

    public function postRegister(RegisterRequest $request){

        $data = $request->except('_token', 'password_confirmation');
        $data['fullname'] = '@user' .mt_rand(100000, 999999999);
        $data['password'] = Hash::make($request->password);
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('getLogin');
    }
    public function getForgot()
    {
        return view('login.forgot');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email'], ['email.exists' => 'Email của bạn chưa được đăng ký.']);
        
        //if user cant submit continuously
        $fiveMinutesAgo = Carbon::now()->subMinutes(5);
        $previousToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('created_at', '>=', $fiveMinutesAgo)
            ->first();
    
        if ($previousToken) {
            return redirect()->route('getLogin')->with('error', 'Email đã được gửi, Vui lòng thử lại sau 5 phút.');
        }
        $token = \Str::random(64);
        \DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $action_link = route('showResetFrom', ['token' => $token, 'email' => $request->email]);
        $body = 'Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản  <b> Quiz</b> được liên kết với ' . $request->email . '. Bạn có thể đặt lại mật khẩu của mình bằng cách nhấp vào liên kết bên dưới';

        \Mail::send('emails.forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('Quiz@gmail.com', 'Quiz.com');
            $message->to($request->email, 'Your name')->subject('Reset Password');
        });

        return redirect()->route('getLogin')->with('success', 'Chúng tôi đã gửi link reset mật khẩu qua email, vui lòng kiểm tra email!');
    }
    public function showResetFrom(Request $request, $token = null)
    {
        return view('login.resetPassword')->with(['token' => $token, 'email' => $request->email]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);

        $check_token = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();
        if (!$check_token) {
            return redirect()
                ->route('getLogin')
                ->with('error', 'Đường dẫn đã hết hạn vui lòng thử lại sau');
        } else {
            User::where('email', $request->email)->update([
                'password' => \Hash::make($request->password),
            ]);

            DB::table('password_reset_tokens')
                ->where([
                    'email' => $request->email,
                ])
                ->delete();

            return redirect()
                ->route('getLogin')
                ->with('success', 'Mật khẩu đã được đổi bạn có thể đăng nhập với mật khẩu mới')
                ->with('verifiedEmail', $request->email);
        }
    }

}
