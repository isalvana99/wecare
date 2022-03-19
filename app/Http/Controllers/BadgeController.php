<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Badge;
use DB;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    public function store2(Request $request)
    {
        $post1 = 0;
        $var = DB::select('SELECT * FROM badges');
        foreach($var as $p){
            if($p->badgeUserId == auth()->user()->id){
                $id = $p->badgeId;
                $post1 = 1;
            }
        }

        $barangay = $request->input('filterbarangay');
        $city = $request->input('filtercity');
        $province = $request->input('filterprovince');

        if($city == "All" && $barangay == "All"){
            $filter = "PROVINCE";
        }else if($city != "All" && $barangay == "All"){
            $filter = "CITY";
        }else if($city != "All" && $barangay != "All"){
            $filter = "BARANGAY";
        }
        

        if($post1 == 0){
            $post = new Badge;
            $post -> badgeUserId = auth()->user()->id;
            $post -> badgeType = $request->input('badge');
            $post -> badgeFilterLocation = $filter;
            $post->save();
        }else{
            $post2 = Badge::find($id);
            $post2->delete();

            $post = new Badge;
            $post -> badgeUserId = auth()->user()->id;
            $post -> badgeType = $request->input('badge');
            $post -> badgeFilterLocation = $filter;
            $post->save();
        }

        return redirect()->back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function destroy2(Request $request)
    {
        $post2 = Badge::find($request->input('badgeid'));
        $post2->delete();
        return redirect()->back();
    }
}
