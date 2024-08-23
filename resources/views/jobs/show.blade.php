@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5"></div>
    @if(Session::has('message'))
        <div class="alert alert-success">
            {{Session::get('message')}}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-company">

                <div class="card-header thead-company text-uppercase font-weight-bold text-dark">{{$job->title}}</div>

                <div class="card-body">
                    <p>
                        <h3>Description</h3>
                        {{$job->description}}
                    </p>
                    <p>
                        <h3>Duties</h3>
                        {{$job->roles}}
                    </p>
                    <p>
                        <h3>Kualifikasi</h3>
                        {{$job->kualifikasi}}
                    </p>
                </div>
            </div>
        </div>        
        <div class="col-md-4">
            <div class="card-company">
                <div class="card-header thead-company font-weight-bold text-dark"><h5>Short Info</h5></div>
                <div class="card-body">
                    <div class="container">
                        <table class="table table-striped table-hover table-sm">
                            <div class="text-center mx-auto">
                                <img src="{{asset('avatar')}}/{{$job->company->logo}}" alt="" width="200px">
                            </div>
                            <div class="py-1"></div>
                            <tbody>
                            <tr>
                                <td>Company</td>
                                <td>:</td>
                                <td><a href="{{route('company.index', [$job->company->id, $job->company->slug])}}">
                                {{$job->company->cname}}</a></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>{{$job->address}}</td>
                            </tr>
                            <tr>
                                <td>Job Possition</td>
                                <td>:</td>
                                <td>{{$job->position}}</td>
                            </tr>
                            <tr>
                                <td>Salary</td>
                                <td>:</td>
                                <td>{{$job->salary_min}} - {{$job->salary_max}}</td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>:</td>
                                <td>{{$job->type}}</td>
                            </tr>
                            <tr>
                                <td>Estimates</td>
                                <td>:</td>
                                <td>{{$job->last_date}}</td>
                            </tr>
                            <tr> <!-- Untuk menambahkan asal web -->
                                <td>From</td>
                                <td>:</td>
                                <td class="text-break">
                                    <a href="{{$job->source}}" target="_blank">{{$job->source}}</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <p>Company: <a href="{{route('company.index', [$job->company->id, $job->company->slug])}}">
                        {{$job->company->cname}}
                        </a> 
                    </p>
                    <p>Adddress: {{$job->address}}</p>
                    <p>Job Position: {{$job->position}}</p>
                    <p>Type: {{$job->type}}</p>
                    <p>Estimates: {{$job->last_date}}</p>                     -->
                </div>
            </div>
            @if (Auth::user()->user_type== 'seeker')                    <!--Agar yang sudah login saja muncul button applynya khusus seeker--> 
                @if (!$job->checkApplication())                    {{-- Agar user hanya bisa apply 1 pekerjaan--}}
                <!-- {{-- <form action="{{route('jobs.apply', [$job->id])}}" method="POST">
                    @csrf
                    <button style="width: 100%" class="btn btn-warning">Apply</button>
                </form> --}} -->
                <!-- <div class="py-2"></div> -->
                    <!-- <apply-component :jobid={{$job->id}}> </apply-component> -->
                @endif
                <div class="py-2"></div>
                {{-- <favorite-component :jobid={{$job->id}} :faborited={{$job->checkSaved() ? 'true':'false'}}> </favorite-component> --}}
                <form action="{{route('jobs.fav')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="job_id" value="{{$job->id}}">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="created_at" value="{{$timestamp = now()}}">
                    <input type="hidden" name="updated_at" value="{{$timestamp = now()}}">
                    <button type="submit" class="btn btn-outline-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                        </svg>&nbsp; Simpan Pekerjaan
                    </button>
                </form>
                <div class="py-1"></div>
                <form action="{{route('jobs.unfav')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="job_id" value="{{$job->id}}">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="created_at" value="{{$timestamp = now()}}">
                    <input type="hidden" name="updated_at" value="{{$timestamp = now()}}">
                    <button type="submit" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-x" viewBox="0 0 16 16">
                            <path d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707 6.854 9.854a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z"/>
                            <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                        </svg>&nbsp; Hapus Pekerjaan
                    </button>
                </form>
            @endif

        </div>
    </div>
</div>
@endsection