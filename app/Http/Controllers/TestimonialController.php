<?php

namespace App\Http\Controllers;

use App\Testimonials;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonials::orderBy('id', 'DESC')->paginate(10);
        return view('backend.testimonials.index')->with('testimonials', $testimonials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonials.create');
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
            'name'      =>'string|required|max:50',
            'rank'      =>'string|required|max:50',
            'comment'   =>'string|nullable',
        ]);
        $data=$request->all();
        $data['photo'] = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('assets/images/testimonials/'), $data['photo']);
        $status=Testimonials::create($data);
        if($status){
            request()->session()->flash('success','Testimonial successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding testimonial');
        }
        return redirect()->route('testimonial.index');
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
        $testimonial = Testimonials::findOrFail($id);
        return view('backend.testimonials.edit')->with('testimonial', $testimonial);
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
        $testimonial=Testimonials::findOrFail($id);
        $this->validate($request,[
            'name'      =>'string|required|max:50',
            'rank'      =>'string|required|max:50',
            'comment'   =>'string|nullable',
        ]);
        $data=$request->all();
        if (!empty($request->photo)) {
            $data['photo'] = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('/assets/images/testimonials/'), $data['photo']);
        }else{
            $data['photo'] = $request->image_hidden;
        }

        $status=$testimonial->fill($data)->save();
        if($status){
            request()->session()->flash('success','Testimonial successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating testimonial');
        }
        return redirect()->route('testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial=Testimonials::findOrFail($id);
        $status=$testimonial->delete();
        if($status){
            request()->session()->flash('success','testimonial successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting testimonial');
        }
        return redirect()->route('testimonial.index');
    }
}
