<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::paginate(10);
        return view('admin.modules.user.index', $data);
    }

    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'password_confirmation');
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = new \DateTime();
        $data['uuid'] = Str::uuid();
        $data['status_user'] = '1';

        $image = $request->avatar;
        $imageName = time() . '-' . $image->getClientOriginalName();

        $destinationPath = public_path('/images/users');
        $imgFile = Image::make($image->getRealPath());
        $imgFile
            ->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPath . '/' . $imageName);

        $data['avatar'] = $imageName;

        $result = User::insert($data);
        if ($result) {
            Mail::to($request->email)->send(new NotifyMail($data));
            return  redirect()
            ->back()->with('success','Thêm thành viên thành công, đã gửi mail vui lòng xác nhận');
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
    public function status_user($uuid, $status)
    {
        User::where('uuid', $uuid)->update(['status_user' => $status]);

        return redirect()
            ->back()
            ->with('success', 'Người dùng đã bị chặn đăng nhập');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('uuid', $id);

        if ($user->exists()) {
            $data['user'] = $user->first();
            return view('admin.modules.user.edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $uuid)
    {
        $user_current = User::where('uuid', $uuid)->first();
        $data = $request->except('_token', 'password_confirmation');
        $data['updated_at'] = new \DateTime();

        if (empty($request->password)) {
            $data['password'] = $user_current->password;
        } else {
            $request->validate(
                [
                    'password' => 'min:8',
                ],
                [
                    'password.min' => 'Mật khẩu ít nhất 8 ký tự',
                ],
            );
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('avatar')) {
            $image_path = public_path('images/users') . '/' . $user_current->avatar;
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();

            $request->avatar->move(public_path('images/users'), $imageName);

            // Resize the avatar image
            $destinationPath = public_path('images/users');
            $imgFile = Image::make($destinationPath . '/' . $imageName);
            $imgFile
                ->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save();

            $data['avatar'] = $imageName;

            if ($user_current->avatar && file_exists($image_path)) {
                unlink($image_path);
            }
        } else {
            $data['avatar'] = $user_current->avatar;
        }

        User::where('uuid', $uuid)->update($data);
        
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Successfully updated');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        if ($user) {
            $imagePath = public_path('images/users') . '/' . $user->avatar;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $user->delete();
            return redirect()
                ->back()
                ->with('success', 'Xóa người dùng thành công.');
        } else {
            abort(404);
        }
    }
}
