<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $admins = Admin::paginate(10);

        return view('admin.list.admins', compact('admins'));
    }

    public function create()
    {
        return view('admin.form.admin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8|confirmed',
            'status' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $admin = new Admin;

        $admin->name = request('name');
        $admin->email = request('email');
        $admin->password = Hash::make(request('password'));
        $admin->status = request('status');

        $file = $request->file('profile_image');
        if($file) {

            $image_name = 'admin-'.time().".".$file->getClientOriginalExtension();

            $img = Image::make($file);

            $img->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if(!File::exists('uploads/admins/')) {
                File::makeDirectory('uploads/admins/');
            }

            

            $img->save('uploads/admins/'.$image_name);
    
            $admin->profile_image = $image_name;                
        }

        $admin->save();

        return redirect('admin/admins')->with('success', 'Admin created.');
    }

    public function edit(Admin $admin)
    {
        return view('admin.form.admin', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'confirmed',
            'status' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // validate if password exists
        if (request('password') != null) {
            $pass = (['password' => request('password')]);

            $v = Validator::make($pass, [
                'password' => 'min:8'
            ]);
    
            if ($v->fails()) {
                return redirect('admin/admins')->withErrors($v)->withInput();
            }

            $data = (['password' => bcrypt(request('password'))]);
            Admin::where('id', $id)->update($data);

        } else {
            $pass = ([]);
        }        
        // validate if password exists

        $data = ([
            'name' => request('name'),
            'email' => request('email'),
            'status' => request('status'),
        ]);

        $file = request()->file('profile_image');
        if($file != null) {

            @unlink('uploads/admins/'.$admin->profile_image);

            $image_name = 'admin-'.time().".".$file->getClientOriginalExtension();

            $img = Image::make($file);
            $img->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            

            $img->save('uploads/admins/'.$image_name);

            $data1 = (['profile_image' => $image_name]);
            Admin::where('id', $id)->update($data1);
        }

        Admin::where('id', $id)->update($data);

        return redirect()->back()->with('success','Admin Updated.');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if(isset($admin)) {
            $affected = Admin::whereId($id)->delete();
            if($affected > 0) {
                @unlink('uploads/admins/'.$admin->profile_image);
                return redirect('admin/admins')->with('success', 'Admin deleted.');
            } else {
                return redirect('admin/admins')->with('error', 'Admin deletion failed.');
            }
        } else {
            return redirect('admin/admins')->with('error', 'Admin not found.');
        }
    }
}
