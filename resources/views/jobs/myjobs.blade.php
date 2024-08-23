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
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="container">
                        @foreach($jobs as $job)    
                            <div class="border p-3 bg-white rounded">
                                <div class="row">
                                    <div class="col-2 text-center align-self-center">
                                        <a href="{{route('jobs.show', [$job->id, $job->slug])}}">
                                            <img class="" src="{{asset('avatar')}}/{{$job->company->logo}}" alt="" width="150px">
                                        </a>
                                    </div>
                                    <div class="col-7">
                                        <a href="{{route('jobs.show', [$job->id, $job->slug])}}" class="font-weight-bold h4">{{$job->title}}</a><br>
                                        <a href="{{route('jobs.show', [$job->id, $job->slug])}}">{{$job->position}}</a><br>
                                        <a href="{{route('company.index', [$job->company->id, $job->company->slug])}}">{{$job->company->cname}}</a> <br>
                                        {{ number_format($job->salary_min, 2) }} - {{ number_format($job->salary_max, 2) }} <br>
                                        <i class="fa fa-map-marker"></i>&nbsp; {{$job->address}} <br>
                                        <i class="fa fa-clock"></i> {{$job->type}} <br>
                                        <i class="fa fa-calendar-check"></i> {{$job->created_at->diffForHumans()}}  
                                    </div>
                                    <div class="col-1 form-inline">
                                        <a class="" href="{{route('jobs.show', [$job->id, $job->slug])}}"> <!--Mengarahkan untuk menampilkan detail dari job  -->
                                            <button type="submit" class="btn btn-outline-success">Detail</button>
                                        </a>
                                        {{-- <br>
                                        <a class="" href="/jobs/edit/{{$job->id}}"> <!--Mengarahkan untuk menampilkan detail dari job  -->
                                            <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                        </a>  --}}
                                        
                                        <form action="{{$job->id}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                              <div class="py-1"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5"></div>
</div>
@endsection
