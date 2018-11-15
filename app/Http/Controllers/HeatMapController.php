<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use Excel;
use File;
use App\HeatMap;
use Auth;
use App\MerchantLocation;

class HeatMapController extends Controller
{



    public function actions(){
        return view('manageBuckets.home');
    }
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
        
        // return view('mawingu.createBucket');
        return view('manageBuckets.createMerchantBucket');
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
            $buckets = MerchantLocation::where('bucket_name' ,'LIKE','%' .$search. '%')->get();;
        
            
         }
         
         if(count($buckets)> 0 ){
            return view('manageBuckets.searchBucket')->withDetails($buckets)->withQuery($search);
        }
        else{
            return view('manageBuckets.searchBucket')->withMessage('Your search for' .  $search. 'was not found');  
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
        $bucket = MerchantLocation::find($id);
       
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

        MerchantLocation::where('id', $id)->update(request(['bucket_name']));
        $this->validate(request(), [
            'bucket_name' => 'required',
            'district' => 'required',
            'bs_name' => 'required',
            'equipment' => 'required',
            'client_type' => 'required',
            'first_name' => 'required',
            'second_name' => 'required',
            'address' => 'required',
            'equipment1' => 'required',
            'ip_address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'bucket_name_ip' => 'required',
           
           
        ]);
        //posting to database

        MerchantLocation::where('id', $id)->update(request(['bucket_name', 'district', 'bs_name','equipment', 'client_type','first_name','second_name','address', 'equipment1', 'ip_address','latitude','longitude','bucket_name_ip']));

        return redirect('/search/Bucket');
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
        MerchantLocation::where('id', $id) ->update([
            'deleted' => 1, 'deleted_on' => date('Y-m-d H:i:s'), 
        ]);
        return redirect('/search/Bucket');
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
                Session::flash("error","Data for ".$request->year ."/". $request->month." is not available");
                // echo ("Data for ".$request->year ."/". $request->month." is not available");
            }
            // return view('heatmap.salesReportMonth');
        }
        // dd($traffic);
        $allBuckets = sizeof($totalSales);
    //    echo ("Hello Modal");
        return view('heatmap.salesReportMonth',compact('allBuckets','request','totalSales','traffic'));
    }
    public function map()
    {
        $coordinates = DB::table('merchant_locations')->get();
        // dd($coordinates);
        foreach($coordinates as $coordinate){
            // echo ('new.google.map.LatLng('.$coordinate->latitude.',' .$coordinate->longitude.')');
        }
        return view('heatmap.coordinates');
    }
    public function mapCoordinates(){
        $coordinates = DB::table('merchant_locations')->join('heat_maps','merchant_locations.bucket_name','=','heat_maps.bucket_name')->get();
        $traffic = DB::table('heat_maps')->get();

        foreach($coordinates as $coordinate){
            // echo ('new google.map.LatLng('.$coordinate->latitude.',' .$coordinate->longitude.')');
        }
        echo json_encode($coordinates);
        // echo json_encode($traffic);
    }
    public function monthlyHeatMap(){
        $month = $request->input('month');
        $year = $request->input('year');

        $filteredCordinates = MerchantLocation::whereYear('created_at', '=', $year)
              ->whereMonth('created_at', '=', $month)
              ->get();

              
    }
}
