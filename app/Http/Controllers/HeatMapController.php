<?php

namespace App\Http\Controllers;
// ini_set('max_execution_time', 500); 
//5 minutes

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Redirect;
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
    public function trafficTemplate($type)
	{
		$data = HeatMap::get()->toArray();
		return Excel::create('trafficTemplate', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
    }
    public function bucketTemplate($type)
	{
		$data = MerchantLocation::get()->toArray();
		return Excel::create('bucketTemplate', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
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
    // public function readData(Request $request)
    // {
    //     //get data
    //     $sales = DB::table('heat_maps')->get();
    //     foreach($sales as $sale){
    //         $date = $sale->throughput_date;
    //         $d = date_parse_from_format("Y-m-d", $date);
    //     }
    //     // $heatmaps = DB::table('heat_maps')->select('latitude', 'longitude')->get();
    //     $heatmaps = DB::join('heat_maps', 'heat_maps.bucket_name', '=', 'merchant_locations.bucket_name')
    //     ->selectRaw('heat_maps.data_throughput', 'merchant_locations.latitude', 'merchant_locations.longitude')
    //     ->where($d["month"] == $request->month) && ($d["year"] == $request->year)
    //     ->get();
    //     // dd($heatmaps);
    //     // echo json_encode($heatmaps);
    //     return response($heatmaps);
    // }

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
        // dd($request);
        $sales = DB::table('heat_maps')->get();
        $totalSales = array();
        $totalTraffic = 0;
        foreach($sales as $sale){
            $date = $sale->throughput_date;
            $d = date_parse_from_format("Y-m-d", $date);
            if(($d["month"] == $request->month) && ($d["year"] == $request->year)){
                array_push($totalSales, $sale->bucket_name);
                $totalTraffic += $sale->data_throughput;
                // dd($totalTraffic);
            }
            else{
                Session::flash("error","Data for ".$request->year ."/". $request->month." is not available");
                // echo ("Data for ".$request->year ."/". $request->month." is not available");
            }
            }
     
        $allBuckets = sizeof($totalSales);
    //    echo ("Hello Modal");
        return view('heatmap.salesReportMonth',compact('allBuckets','request','totalSales','totalTraffic'));
    }
    public function map()
    {
        if(Input::get('month') ==null){
        
        $coordinates = DB::table('merchant_locations')->get();
        // dd($coordinates);
        foreach($coordinates as $coordinate){
            // echo ('new.google.map.LatLng('.$coordinate->latitude.',' .$coordinate->longitude.')');
        }
        // echo json_encode($coordinates);
        return view('heatmap.coordinates');
    }else{
        $coordinates = DB::table('merchant_locations')->join('heat_maps','merchant_locations.bucket_name','=','heat_maps.bucket_name')->get();
        // $traffic = DB::table('heat_maps')->get();
        // dd($coordinates);
        $response = [];
        foreach($coordinates as $sale){
          $date = $sale->throughput_date;
          $d = date_parse_from_format("Y-m-d", $date);
        //   dd($d["month"]);
         if(($d["month"] == Input::get('month')) && ($d["year"] == Input::get('year'))){
            $coordinate = DB::table('merchant_locations')->join('heat_maps','merchant_locations.bucket_name','=','heat_maps.bucket_name')->where('throughput_date',$date)->get();
                // echo json_encode($coordinate);
                $response['matched'] = $coordinate;
                // dd($response);
            }
            else{
                // Session::flash('error', 'No data available here. Change the month or year');
                $response['unmatched'] = Session::flash('error', 'No data available here. Change the month or year');
                // dd('No data available here. Change the month or year');
                    // return back();
            }
            // Session::put($response);
            // echo json_encode($response);
            // echo json_encode($coordinates);
        //     return Redirect::route( 'mapCoordinates' )
        // ->with( 'response', $response );
        // return redirect()->route('mapCoordinates', ['response' => $response]);
        // return Redirect::route('mapCoordinates', array('response' => $response));
        // return redirect()->action(
            // 'HeatMapController@mapCoordinates', ['response' => response]
        // );
        }
        // return Redirect::to('mapCoordinates/'.$response) ;
        // echo json_encode($coordinates);
    }
    echo json_encode($coordinates);
}
 
        

    public function mapCoordinates($month, $year){
    // $coordinates = DB::table('merchant_locations')->join('heat_maps','merchant_locations.bucket_name','=','heat_maps.bucket_name')->get();
    DB::table('merchant_locations')
            ->join('heat_maps','merchant_locations.bucket_name','=','heat_maps.bucket_name') 
            ->orderBy('heat_maps.throughput_date')  
            ->chunk(300,function($coordinates){

   
        // $traffic = DB::table('heat_maps')->get();
        dd($coordinates);
        $response = [];
        foreach($coordinates as $sale){
          $date = $sale->throughput_date;
          $d = date_parse_from_format("Y-m-d", $date);
        //   dd($d["month"]);
         if(($d["month"] == $month) && ($d["year"] == $year)){
            $coordinate = DB::table('merchant_locations')->join('heat_maps','merchant_locations.bucket_name','=','heat_maps.bucket_name')->where('throughput_date',$date)->get();
                echo json_encode($coordinate);
                // $response['matched'] = $coordinate;
                // dd($response);
            }
            else{
                // Session::flash('error', 'No data available here. Change the month or year');
                $response['unmatched'] = Session::flash('error', 'No data available here. Change the month or year');
                // dd('No data available here. Change the month or year');
                    // return back();
            }
          
            // echo json_encode($coordinates);
        }
    });
        //   if($response == $response['matched']){
        //         echo json_encode($response['matched']);
        //     // dd($response == $response['matched']);
        //     }
        //     else echo json_encode($response);
        // dd($response = $response['matched']);
        // echo json_encode($coordinates);
        // dd($response);
        // $response = Session::get('response');

        // dd($response);
        // echo json_encode($response);
      

    }
    
    public function heatMapReports(){
        
    }
    public function filterheatMap(){
        return view('heatmap.searchHeatMap');
    }
}
