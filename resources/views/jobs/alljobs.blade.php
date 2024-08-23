@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5"></div>
    <div class="row">
        <h3 class="display-4 fontrek">Pekerjaan Terbaru</h3>
        
    </div>
    <div class="py-2"></div>
    <div class="row">
        <div class="col">
            <form action="{{route('alljobs')}}" method="GET">
                <div class="text-center mx-auto">
                    <div class="form-group">
                        <input type="text" name="title" id="" placeholder="Kata Kunci | Nama Pekerjaan | Posisi" class="text-center form-control">
                        <input type="text" name="salary_min" id="" placeholder="Gaji Minimum" class="text-center form-control">
                        <input type="text" name="salary_max" id="" placeholder="Gaji Maksimum" class="text-center form-control">
                        <input type="text" name="type" id="" placeholder="Tipe Pekerjaan" class="text-center form-control">
                        <input type="text" name="address" id="" placeholder="Daerah Kerja" class="text-center form-control">
                    </div>        
                    <div class="form-group">
                        <button class="btn btn-outline-dark">Cari Pekerjaan</button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
    <div class="py-3"></div>
    <div class="container">
        @foreach($jobs as $job)    
            <div class="shadow p-3 bg-white rounded">
                <div class="row">
                    <div class="col-2 text-center align-self-center">
                        <a href="{{route('jobs.show', [$job->id, $job->slug])}}">
                            <img class="" src="{{asset('avatar')}}/{{$job->company->logo}}" alt="" width="150px">
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{route('jobs.show', [$job->id, $job->slug])}}" class="font-weight-bold h4">{{$job->title}}</a><br>
                        <a href="{{route('jobs.show', [$job->id, $job->slug])}}">{{$job->position}}</a><br>
                        <a href="{{route('company.index', [$job->company->id, $job->company->slug])}}">{{$job->company->cname}}</a> <br>
                        {{ number_format($job->salary_min, 2) }} - {{ number_format($job->salary_max, 2) }} <br>
                        <i class="fa fa-map-marker"></i>&nbsp; {{$job->address}} <br>
                        <i class="fa fa-clock"></i> {{$job->type}} <br>
                        <i class="fa fa-calendar-check"></i> {{$job->created_at->diffForHumans()}}  
                    </div>
                    <div class="col-2 align-self-center">
                        <a class="" href="{{route('jobs.show', [$job->id, $job->slug])}}"> <!--Mengarahkan untuk menampilkan detail dari job  -->
                            <button type="submit" class="btn btn-outline-primary">Detail</button>
                        </a>
                    </div>
                </div>
            </div>
      		<div class="py-1"></div>
        @endforeach
        <div class="">
            {{$jobs->appends($_GET)->links()}}
        </div>
    </div>
    <div class="py-2"></div>
</div>


@endsection

