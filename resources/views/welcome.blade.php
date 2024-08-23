@extends('layouts.app')

@section('content')
    <!-- jumbrotron -->
    <div class="jumbotron jumbotron-fluid ">
        <div class="container1">
            <div class="rounded bg-transparent">
                <h1 class="">Discover Your Dream Job!</h1>
            </div>
            {{-- <div class="row">
                <div class="col"></div>
                <div class="col-6 mx-auto">
                    <search-component></search-component>
                </div>
                <div class="col"></div>
                
            </div> --}}
            <form action="{{route('alljobs')}}" method="GET" class="search-form">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col">
                        <search-component></search-component>
                            {{-- <div class="form-group has-feedback">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" class="text-center form-control" name="title" id="" placeholder="Kata Kunci | Nama Pekerjaan | Posisi | Gaji | dll.">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div> --}}
                        {{-- <div class="row">
                            <div class="col"></div>
                            <div class="col-6 mx-auto">
                                <search-component></search-component>
                            </div>
                            <div class="col"></div>
                            
                        </div> --}}
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <button class="btn btn-link text-center text-light btn-outline-light">Cari Semua Pekerjaan</button>
                    <div class="col"></div>
                </div>
            </form>
            {{-- <script type="text/javascript">
                $('#title').on('keyup',function(){
                    $value=$(this).val();
                    $.ajax({
                        type : 'get',
                        url : '{{URL::to('title')}}',
                        data:{'title':$value},
                        success:function(data){
                            $('tbody').html(data);
                        }
                    });
                })
            </script>   
            <script type="text/javascript">
                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            </script>             --}}
            <div class="py-1"></div>
            <div class="">
                <div class="col">
                </div>
                {{-- <button class="btn btn-link text-center text-light btn-outline-light"><a class="text-light" href="{{route('alljobs')}}">Cari Semua Pekerjaan</a></button> --}}
                <button class="btn btn-link text-center text-light " data-toggle="collapse" data-target="#hide">Pencarian Lengkap 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                        <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                    </svg>
                </button>
                
            </div>
            <div class="py-1"></div>
                <div class="collapse" id="hide">
                    <!-- Advance -->
                    <div class="row d-flex justify-content-center ">
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
            </div>
    </div>
    <!-- akhir Jumbrotron -->        
<div class="container">
    <div class="row py-1">
        <div class="col">
            <h3 class="display-4 fontrek">Rekomendasi Pekerjaan</h3>
            <p class="lead fontmini">Rekomendasi pekerjaan yang mungkin cocok dengan anda?</p>
            <div class="py-2"></div>
            @foreach($jobs as $job)  
                <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
                    <div class="row no-gutters">
                      <div class="col-md-3 align-self-center text-center">
                        <a href="{{route('jobs.show', [$job->id, $job->slug])}}">
                            <img src="{{asset('avatar')}}/{{$job->company->logo}}" alt="" width="200px">
                        </a>
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">
                                      <a class="text-decoration-none" href="{{route('jobs.show', [$job->id, $job->slug])}}">
                                          {{$job->position}}
                                      </a>
                                    </h5>
                                    <a href="{{route('company.index', [$job->company->id, $job->company->slug])}}">{{$job->company->cname}}</a> <br>
                                    {{ number_format($job->salary_min, 2) }} - {{ number_format($job->salary_max, 2) }} <br>
                                    <p class="card-text">{{$job->address}}</p>
                                    <p class="card-text">
                                        <div class="col">
                                            <small class="text-muted"><i class="fa fa-clock"></i>&nbsp;{{$job->type}}</small>
                                        </div>
                                        <div class="col">
                                            <small class="text-muted"><i class="fa fa-calendar-check"></i>&nbsp;Tanggal Upload: {{$job->created_at->diffForHumans()}}</small>
                                        </div>
                                    </p>
                                    <p class="card-text"></p>
                                </div>
                                <div class="col-6 align-self-center">
                                    <div class="d-flex justify-content-end ">
                                        {{-- @guest --}}
                                            {{-- @if (Auth::user()->user_type=='seeker')                    <!--Agar yang sudah login saja muncul button applynya khusus seeker-->  --}}
                                                {{-- <favorite-component :jobid={{$job->id}} :favorited={{$job->checkSaved() ? 'true':'false'}}> </favorite-component> --}}
                                            {{-- @elseif (Auth::user()->user_type=='') --}}
                                                <a href="{{route('jobs.show', [$job->id, $job->slug])}}" type="button" class="btn btn-outline-primary ">Detail Pekerjaan</a>
                                            {{-- @endif --}}
                                        {{-- @endguest --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
    <div class="container">
        <h3 class="display-4 fontrek">Rekomendasi Perusahaan</h3>
        <p class="lead fontmini">Rekomendasi perusahaan yang mungkin cocok dengan anda?</p>
        <div class="row">
        @foreach ($companies as $company)
            <div class="col-md-3 rounded">
                <div class="card" style="width: 16rem;">
                    <a href="{{route('company.index', [$company->id, $company->slug])}}"><img class="card-img-top" src="{{asset('avatar')}}/{{$company->logo}}" alt="{{$company->cname}}"></a>
                    <div class="card-body">
                        <a href="{{route('company.index', [$company->id, $company->slug])}}"><h5 class="card-title text-truncate">{{$company->cname}}</h5></a>
                      <p class="card-text">{{str_limit($company->description, 20)}}</p>
                      <a href="{{route('company.index', [$company->id, $company->slug])}}" class="btn btn-primary" style="background-color : #114386;">Lihat Perusahaan</a>
                    </div>
                </div>
                <div class="py-2"></div>
            </div>
        @endforeach
        </div>
    </div>
    <div class="container pt-5">
        <h3 class="display-4 fontrek">Artikel Terbaru</h3>
        <p class="lead fontmini">Artikel yang mungkin cocok untuk anda</p>
        <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="thumbnail ">
                    <img class="" src="{{asset('interest/artikel1.png')}}" style="width:100%">
                    <P><B>Rebranding guide : Cara Sukses Rebranding di Tahun 2021 dengan Mudah</B></P>
                    <div class="caption">
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="thumbnail ">
                    <img class="" src="{{asset('interest/artikel2.png')}}" style="width:100%">
                    <div class="caption">
                      <p><b>Google Meet Segera Beri Opsi Baru untuk Kita Memulai Rapat</b></p>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="thumbnail ">
                    <img class="" src="{{asset('interest/artikel3.png')}}"  style="width:100%">
                    <div class="caption">
                      <p><b>Procreate Tips : Cara Membuat dan Sesuaikan Brush Procreate</b></p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
        </div>
        <div class="py-2"></div>
        <div class="row">
            <div class="col text-center text-align-center">
                <a href="{{ route('blog') }}" class="btn btn-primary" style="background-color : #114386;">Lihat Lebih Banyak</a>
            </div>
        </div>
    </div>
    
</div>

@endsection
