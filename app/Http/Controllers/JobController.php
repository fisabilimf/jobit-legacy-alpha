<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Job;
use App\Company;
use App\Http\Requests\JobPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;

class JobController extends Controller
{
    public function index(){
        //$jobs = Job::all()->take(10);//take digunakan untuk melimitasi data yang diambil
        $jobs = Job::inRandomOrder()->limit(10)->get();
        $companies = Company::inRandomOrder()->limit(12)->get();
        return view('welcome', compact('jobs', 'companies'));
    }

    public function show($id, Job $job){
        if (Auth::check() && Auth::user()->user_type==('employer'||'seeker')) {
            return view('jobs.show', compact('job'));
        } else {
            return redirect()->route('login')->with('message', 'Mohon login terlebih dahulu');
        }
        
    }

    public function create() {
        return view('jobs.create');
    }

    public function edit($id){
        DB::table('jobs')->where('id',$id)->get();
        return view('jobs.edit', ['jobs' => $jobs]);
    }

    public function update(Request $request){
        DB::table('jobs')->where('id',$id)->update([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug'=> str_slug(request('title')),
            'roles'=> request('roles'),
            'salary_min' => request('salary_min'),
            'salary_max' => request('salary_max'),
            'description'=> request('description'),
            'category_id'=> request('category'),
            'position' => request('position'),
            'kualifikasi' => request('kualifikasi'),
            'address' => request('address'),
            'type' => request('type'),
            'status' => request('status'),
            'last_date' => request('last_date'),
            'source' => request('source'),
        ]);
        
        return view('jobs.edit', ['jobs' => $jobs]);
    }    

    public function destroy($id){
        DB::table('jobs')->where('id',$id)->delete();
        return redirect()->back()->with('message','Berhasil menghapus data!');
    }

    public function store(JobPostRequest $request) {
        $user_id = auth()->user()->id;
        $company = Company::where('user_id', $user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug'=> str_slug(request('title')),
            'roles'=> request('roles'),
            'salary_min' => request('salary_min'),
            'salary_max' => request('salary_max'),
            'description'=> request('description'),
            'category_id'=> request('category'),
            'position' => request('position'),
            'kualifikasi' => request('kualifikasi'),
            'address' => request('address'),
            'type' => request('type'),
            'status' => request('status'),
            'last_date' => request('last_date'),
            'source' => request('source'),
            
        ]);

        return redirect()->back()->with('message', 'Job Posted Succesfully');
    }



    public function myJobs() {
        $jobs = Job::where('user_id', auth()->user()->id)->get();
        return view ('jobs.myjobs', compact('jobs'));
    }

    public function apply (Request $request, $id){
        $jobId = Job::find($id);
        $jobId->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message', 'Job Applied Succesfully');
    }

    public function applicants(){
        $applicants = Job::has('users') -> where('user_id', auth()->user()->id)->get();
        return view('jobs.applicants', compact('applicants'));
    }

    public function alljobs(Request $request) {
        $keyword = request('title');
        $salmin = request('salary_min');
        $salmax = request('salary_max');
        $type = request('type');
        $category = request('category_id');
        $address = request('address');
        
        if($request!=null){ // Pembuatan logika filter pekerjaan
            // $jobs = Job::where('title', 'LIKE', '%'.$keyword.'%')
            //     ->orWhere('salary_min', 'LIKE', $salmin)
            //     ->orWhere('salary_max', 'LIKE', $salmax)
            //     ->orWhere('type', 'LIKE', '%'.$type.'%')
            //     ->orWhere('category_id', 'LIKE', '%'.$category.'%')
            //     ->orWhere('address', 'LIKE', '%'.$address.'%')
            //     ->paginate(10);

            // return view ('jobs.alljobs', compact('jobs'));

            $jobs = Job::where([
                ['title', 'LIKE', '%'.$keyword.'%'],
                ['salary_min', 'LIKE', $salmin],
                ['salary_max', 'LIKE', $salmax],
                ['type', 'LIKE', '%'.$type.'%'],
                ['category_id', 'LIKE', '%'.$category.'%'],
                ['address', 'LIKE', '%'.$address.'%'],
            ])->paginate(10);
                
            return view ('jobs.alljobs', compact('jobs'));

        } else {
            $jobs = Job::paginate(10);

            return view ('jobs.alljobs', compact('jobs'));
        }
    }

    public function searchJob(Request $request){
        $keyword = $request ->get('keyword');
        $users = Job::where('title', 'LIKE', '%'.$keyword.'%')
                -> orWhere('position', 'LIKE', '%'.$keyword.'%')
                ->limit(5)->get();
        return response()->json($users);
    }
    
    public function fav(Request $request){
        DB::table('favourites')->insert([
            'job_id' => $request->job_id,
            'user_id' => $request->user_id,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);
        return redirect()->back()->with('message','Berhasil menyimpan!');
    }

    public function unfav(Request $request){
        DB::table('favourites')->where([
            'job_id' => $request->job_id,
        ])->delete();
        return redirect()->back()->with('message','Berhasil dihapus!');
    }

}
