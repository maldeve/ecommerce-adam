<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Excel;
use File;

class HeatMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadIndex(){

        return view('heatmap.uploadExcel');
    }
    public function uploadExcel(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
        if($request->hasFile('file')){
            // dd($request->hasFile('file'));
            $extension = File::extension($request->file->getClientOriginalName());
            // dd($extension);
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                // dd($extension == "xls");
                $path = $request->file->getRealPath();
                // dd($path); = "C:\xampp\tmp\phpE695.tmp"
                $data = Excel::load($path, function($reader) {
                })->get();
                // dd($data);
                if(!empty($data) && $data->count()){
 
                    foreach ($data as $key => $value) {
                        // dd($value->Bucket_Nmae);
                        $insert[] = [
                        'bucket_name' => $value->bucket_name,
                        'data_throughput' => $value->data_throughput,
                        'latitude' => $value->latitude,
                        'longitude' => $value->longitude,
                        ];
                    }
 
                    if(!empty($insert)){
 
                        $insertData = DB::table('heat_maps')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
 
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }
 

    public function index()
    {
        //
        return view('mawingu.heatMap');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mawingu.createBucket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(request(), [
            'bucket_name' =>'required',
            'data_througput' =>'required',
            'latitude' =>'required',
            'longitude' =>'required',
           
        ]);
        HeatMap::create(request([
            'bucket_name',
            'data_througput',
            'latitude',
            'longitude',
        ]));

        return redirect('/heatMap');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function readData()
    {
        //get data
        $heatmaps = HeatMap::all();
        return view('mawingu.heatMap', compact('heatmaps'));
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
}
