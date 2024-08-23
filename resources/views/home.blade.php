@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5"></div>
    @if(Session::has('message'))
        <div class="alert alert-danger">
            {{Session::get('message')}}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user()->user_type=='seeker')
                <h3 class="fontrek">Saved Jobs</h3>
                @foreach ($jobs as $job)
                <div class="pt-3"></div>
                    <div class="card">
                        <div class="card-header form-inline">
                            <div class="col">
                                {{$job->title}}
                            </div>
                            <div class="nav justify-content-end">
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
                            </div>
                        </div>
                        
                        <div class="card-body">
                            {{-- @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif 
                            You are logged in! --}}
                            {{$job->description}}
                        </div>
                        
                        <div class="card-footer">
                            <span>
                                <a href="{{route('jobs.show', [$job->id, $job->slug])}}">Read More</a>
                            </span>
                            <span class="float-right">
                                {{$job->last_date}}
                            </span>
                        </div>
                        
                    </div> 
                
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
