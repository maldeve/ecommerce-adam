<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Excel;
use File;
<<<<<<< HEAD
use Illuminate\Support\Facades\Input;
use App\HeatMap;
use Auth;

=======
use App\HeatMap;
use App\MerchantLocation;
>>>>>>> a1c20320294bbfb81bd723c64c671c323a066c60

class HeatMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadIndex(){
        // dd(DB::table('heat_maps')->get());
        return view('heatmap.uploadExcel');
    }
    public function indexBucket(){
        // dd(DB::table('heat_maps')->get());
        return view('heatmap.uploadBucketExcel');
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
                        'throughput_date' => $value->throughput_date,
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
 

    public function uploadBucket(Request $request){
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
                        'latitude' => $value->latitude,
                        'longitude' => $value->longitude,
                        ];
                    }
 
                    if(!empty($insert)){
 
                        $insertData = DB::table('merchant_locations')->insert($insert);
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
<<<<<<< HEAD
        return view('manageBuckets.createBucket');
=======
        // return view('mawingu.createBucket');
        return view('mawingu.createMerchantBucket');
>>>>>>> a1c20320294bbfb81bd723c64c671c323a066c60
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
            'latitude' =>'required',
            'longitude' =>'required',
           
        ]);
        MerchantLocation::create(request([
            'district','bs_name','equipment','client_type','first_name','second_name','second_name','address','equipment1','ip_address','bucket_name','latitude','longitude','bucket_name_ip'
        ]));

        return redirect('/heatMap');
    }

    public function displaySearch(){
        $search = Input::get("search");
        if( $search !=""){
            $buckets = HeatMap::where('bucket_name' ,'LIKE','%' .$search. '%')->get();;
            
         }
         
         if(count($buckets)> 0 ){
            return view('manageBuckets.searchBucket')->withDetails($buckets)->withQuery($search);
        }
        else{
            return view('manageBuckets.searchBucket')->withMessage('no user found');  
        }
       
    }


    function displayForm(){
        return view("manageBuckets.searchBucket");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function readData()
    {
<<<<<<< HEAD
        //

=======
        //get data
        $heatmaps = HeatMap::all();
        return view('mawingu.heatMap', compact('heatmaps'));
>>>>>>> a1c20320294bbfb81bd723c64c671c323a066c60
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
        $bucket = heatMap::find($id);
       
       return view('manageBuckets.edit', compact('bucket'));
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
        $this->validate(request(), [
            'bucket_name' => 'required',
            
        ]);
        //posting to database

        heatMap::where('id', $id)->update(request(['bucket_name']));
        $this->validate(request(), [
            'bucket_name' => 'required',
           
        ]);
        //posting to database

        heatMap::where('id', $id)->update(request(['bucket_name']));

        return redirect('/bucket');
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
        HeatMap::where('id', $id) ->update([
            'deleted' => 1, 'deleted_on' => date('Y-m-d H:i:s'), 
        ]);
        return redirect('/');
    }
    public function salesIndex(){
        return view('heatmap.salesReport');
    }
    public function salesReport(Request $request){
        // dd($request->year);
        $sales = DB::table('heat_maps')->get();
        $totalSales = array();
        $totalTraffic = array();
        foreach($sales as $sale){
            $date = $sale->throughput_date;
            $d = date_parse_from_format("Y-m-d", $date);
            // dd($d["year"] == $request->year);
            if(($d["month"] == $request->month) && ($d["year"] == $request->year)){
                array_push($totalSales, $sale->bucket_name);
                $traffic = DB::table('heat_maps')->sum('data_throughput');
                // $result = mysql_query('SELECT SUM(data_throughput) AS data_throughput FROM heat_maps'); 
                
                // dd(sizeof($totalSales));
                // $row = mysql_fetch_assoc($result); 
                // $sum = $row['data_throughput'];
                // dd($sum);
            }
            else{
                echo ("Data for ".$request->year ."/". $request->month." is not available");
            }
            // return view('heatmap.salesReportMonth');
        }
        $allBuckets = sizeof($totalSales);
    //    echo ("Hello Modal");
        return view('heatmap.salesReportMonth',compact('allBuckets','request','totalSales','traffic'));
    }
}
