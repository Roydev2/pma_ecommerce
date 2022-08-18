<?php

namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::orderBy('id', 'DESC')->paginate(10);
        return view('backend.feature.index')->with('features', $features);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required|max:50',
            'text'=>'string|nullable',
        ]);
        $data=$request->all();
        $data['photo'] = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('assets/images/feature/'), $data['photo']);
        $status=Feature::create($data);
        if($status){
            request()->session()->flash('success','Feature successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding feature');
        }
        return redirect()->route('feature.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return view('backend.feature.edit')->with('feature', $feature);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $feature=Feature::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required|max:50',
            'text'=>'string|nullable',
        ]);
        $data=$request->all();
        if (!empty($request->photo)) {
            $data['photo'] = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('/assets/images/feature/'), $data['photo']);
        }else{
            $data['photo'] = $request->image_hidden;
        }

        $status=$feature->fill($data)->save();
        if($status){
            request()->session()->flash('success','Feature successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating feature');
        }
        return redirect()->route('feature.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature=Feature::findOrFail($id);
        $status=$feature->delete();
        if($status){
            request()->session()->flash('success','Feature successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting feature');
        }
        return redirect()->route('feature.index');
    }
}
