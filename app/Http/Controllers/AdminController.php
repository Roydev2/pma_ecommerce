<?php

namespace App\Http\Controllers;

use App\AboutUs;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\User;
use App\Rules\MatchOldPassword;
use Hash;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
class AdminController extends Controller
{
    public function index(){
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     $array[] = ['Name', 'Number'];
     foreach($data as $key => $value)
     {
       $array[++$key] = [$value->day_name, $value->count];
     }
    //  return $data;
     return view('backend.index')->with('users', json_encode($array));
    }

    public function profile(){
        $profile=Auth()->user();
        // return $profile;
        return view('backend.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id){
        // return $request->all();
        $user=User::findOrFail($id);
        $data=$request->all();
        if (!empty($request->photo)) {
            $data['photo'] = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('/assets/users/'), $data['photo']);
        }else{
            $data['photo'] = $request->image_hidden;
        }
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated your profile');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }
        return redirect()->back();
    }

    public function settings(){
        $data=Settings::first();
        return view('backend.setting')->with('data',$data);
    }

    public function settingsUpdate(Request $request){
        // return $request->all();
        $this->validate($request,[
            'company_name'      =>'required|string',
            'short_des'         =>'required|string',
            'description'       =>'required|string',
            // 'photo'=>'required',
            // 'logo'=>'required',
            'address'           =>'required|string',
            'email'             =>'required|email',
            'phone'             =>'required|string',
            'currency'          =>'required|string',
        ]);
        $data=$request->all();
        if (!empty($request->photo)) {
            $data['photo'] = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('/assets/images/setting/'), $data['photo']);
        }else{
            $data['photo'] = $request->old_photo;
        }

        if (!empty($request->logo)) {
            $data['logo'] = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('/assets/images/setting/'), $data['logo']);
        }else{
            $data['logo'] = $request->old_logo;
        }

        if (!empty($request->about_breadcrumb)) {
            $data['about_breadcrumb'] = time() . '.' . $request->about_breadcrumb->extension();
            $request->about_breadcrumb->move(public_path('/assets/images/setting/'), $data['about_breadcrumb']);
        }else{
            $data['about_breadcrumb'] = $request->old_about_breadcrumb;
        }

        if (!empty($request->product_breadcrumb)) {
            $data['product_breadcrumb'] = time() . '.' . $request->product_breadcrumb->extension();
            $request->product_breadcrumb->move(public_path('/assets/images/setting/'), $data['product_breadcrumb']);
        }else{
            $data['product_breadcrumb'] = $request->old_product_breadcrumb;
        }
        // return $data;
        $settings=Settings::first();
        // return $settings;
        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Setting successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('admin');
    }

    public function changePassword(){
        return view('backend.layouts.changePassword');
    }
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('admin')->with('success','Password successfully changed');
    }

    // Pie chart
    public function userPieChart(Request $request){
        // dd($request->all());
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     $array[] = ['Name', 'Number'];
     foreach($data as $key => $value)
     {
       $array[++$key] = [$value->day_name, $value->count];
     }
    //  return $data;
     return view('backend.index')->with('course', json_encode($array));
    }

    // public function activity(){
    //     return Activity::all();
    //     $activity= Activity::all();
    //     return view('backend.layouts.activity')->with('activities',$activity);
    // }
}
