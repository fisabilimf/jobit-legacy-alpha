@extends('layouts.app')

@section('content')
<div class="py-2"></div>
<div class="container">
    {{-- <div class="py-5"></div> --}}
    <div class="card-company">
        <div class="company-profile">
            {{-- <img src="{{asset('cover/banner_default.png')}}" alt="" width="1150" height="200" > --}}
            <img style=" width: 100%; " src="{{asset('cover')}}/{{$company->cover_photo}}" alt="" >
            {{-- @if (empty(Auth::user()->company->cover_photo))
            @else
                <img style=" width: 100%; " src="{{asset('cover')}}/{{Auth::user()->company->cover_photo}}" alt="">
            @endif             --}}
        </div>
        <div class="atas">
            <div class="company-desc"> 
                <br>
                {{-- <img src="{{asset('avatar/default.png')}}" alt="" width="100"> --}}
                <img class="img-company rounded-lg" style=" " src="{{asset('avatar')}}/{{$company->logo}}" alt="" width="200px">
                {{-- @if (empty(Auth::user()->company->logo))
                @else
                    <img class="img-company rounded-lg" style=" " src="{{asset('avatar')}}/{{Auth::user()->company->logo}}" alt="" >
                @endif --}}
                <div class="py-2"></div>
                <div class="company-desc-write">
                    <h1 class="text-center">{{$company->cname}}</h1>
                    <div class="py-2"></div>
                    <p class="text-justify">{{$company->description}}</p>
                    <table>
                        <tr>
                            <td>Slogan</td>
                            <td>:</td>
                            <td class="text-break">{{$company->slogan}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td class="text-break">{{$company->address}}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>:</td>
                            <td class="text-break">{{$company->phone}}</td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>:</td>
                            <td class="text-break"><a class="" href="{{$company->website}}" target="_blank">{{$company->website}}</a></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        
        

    </div>
    <div class="py-2"></div>
    <div class="card-company">
        <table class="table ">
            <thead class="thead-company">
               <th colspan="5"> Daftar Pekerjaan Perusahaan</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="container">
                            @foreach($company->jobs as $job)    
                                <div class="border p-3 bg-white rounded">
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
                                                <button type="submit" class="btn btn-success btn-sm">Detail</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                  <div class="py-1"></div>
                            @endforeach
                        </div>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
