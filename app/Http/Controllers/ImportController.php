<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Import;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index(){
        return view('import');
      }
    
      public function uploadFile(Request $request){
    
        if ($request->input('submit') != null ){
    
          $file = $request->file('file');
    
          // File Details 
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();
    
          // Valid File Extensions
          $valid_extension = array("csv");
    
          // 2MB in Bytes
          $maxFileSize = 2097152; 
    
          // Check file extension
          if(in_array(strtolower($extension),$valid_extension)){
    
            // Check file size
            if($fileSize <= $maxFileSize){
    
              // File upload location
              $location = 'uploads';
    
              // Upload file
              $file->move($location,$filename);
    
              // Import CSV to Database
              $filepath = public_path($location."/".$filename);
    
              // Reading file
              $file = fopen($filepath,"r");
    
              $importData_arr = array();
              $i = 0;
    
              while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                 $num = count($filedata );
                 
                 // Skip first row (Remove below comment if you want to skip the first row)
                 /*if($i == 0){
                    $i++;
                    continue; 
                 }*/
                 for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);
    
              // Insert to MySQL database
              foreach($importData_arr as $importData){
    
                $insertData = array(
                   "user_id"=>$importData[0],
                   "title"=>$importData[1],
                   "slug"=>$importData[2],
                   "roles"=>$importData[3],
                   "position"=>$importData[3],
                   "source"=>$importData[4],
                   "address"=>$importData[6],
                   "image"=>$importData[7],
                   "description"=>$importData[8],
                   "type"=>$importData[9],
                   "created_at" => date('Y-m-d H:i:s'),
                   "updated_at" => date('Y-m-d H:i:s'),
                   "salary_min"=>str_replace(',', '', $importData[10]),
                   "salary_max"=>str_replace(',', '', $importData[11]));
                Import::insertData($insertData);
    
              }
    
              Session::flash('message','Import Successful.');
            }else{
              Session::flash('message','File too large. File must be less than 2MB.');
            }
    
          }else{
             Session::flash('message','Invalid File Extension.');
          }
    
        }
    
        // Redirect to index
        return redirect()->action('ImportController@index');
      }
}
