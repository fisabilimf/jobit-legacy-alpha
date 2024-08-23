@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5"></div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Company Details
                </div>
                <div class="card-body">
                   <p><b>Company Name :</b> {{Auth::user()->company->cname}}</p>
                   <p><b>Email :</b> {{Auth::user()->email}}</p>
                   <p><b>Address :</b> {{Auth::user()->address}}</p>
                   <p><b>Company Page :</b> <a href="company/{{Auth::user()->company->slug}}">View</a></p>
                   <p><b>Phone :</b> {{Auth::user()->company->phone}}</p>
                   <p><b>Website :</b> {{Auth::user()->company->website}}</p>
                   <p><b>Slogan :</b> {{Auth::user()->company->slogan}}</p>
                   <p><b>Description :</b> {{Auth::user()->company->description}}</p>
                </div>
            </div>

            

        </div>
    </div>
    <div class="py-2"></div>
    <div class="row">
        <div class="col-md-4">
            {{-- <img style="border-radius: 50px; width: 100%" src="{{asset('avatar/default.png')}}" alt="" width="100" height="200"> --}}
            @if (empty(Auth::user()->company->logo))
                <img class="img-company rounded-lg" style=" " src="{{asset('avatar')}}/{{Auth::user()->company->logo}}" alt="" width="100px">
            @else
                <img style="border-radius: 50px; width: 100%" 
                     src="{{asset('avatar')}}/{{Auth::user()->company->logo}}" 
                     alt="" width="100" >
            @endif
            <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <br>
                <div class="card">
                    <div class="card-header">
                        Change Your Company Profile!
                    </div>
                    <div class="card-body">
                        <input class="form-control" type="file" name="logo" id="">
                        <br>
                        <button class="btn btn-primary">Update</button>
                    </div>
                    {{-- Error Exception jika logodikosongkan--}}
                    @if ($errors->has('logo'))
                    <div class='error' style="color: red">
                        &nbsp; {{$errors -> first('logo')}}
                    </div>                            
                    @endif
                </div>
            </form>
            <div class="py-2"></div>
            <form action="{{route('company.coverphoto')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        Update Cover Photo
                    </div>
                    <div class="card-body">
                        <input class="form-control" type="file" name="cover_photo" id="">
                        <br>
                        <button class="btn btn-primary">Update</button>
                    </div>
                    {{-- Error Exception jika cover_letter dikosongkan--}}
                    @if ($errors->has('cover_photo'))
                    <div class='error' style="color: red">
                        &nbsp; {{$errors -> first('cover_photo')}}
                    </div>                            
                    @endif
                </div>
            </form>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Update Your Information
                </div>
                <div class="card-body">
                    <form action="{{route('company.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">
                                Address
                            </label>
                            <textarea class="form-control" name="address" id="" cols="30" rows="3">
                                
                            </textarea>
                        </div>
                        {{-- Error Exception jika address dikosongkan--}}
                        @if ($errors->has('address'))
                            <div class='error' style="color: red">
                            {{$errors -> first('address')}}
                            </div>                            
                        @endif

                        <div class="form-group">
                            <label for="">
                                Phone
                            </label>
                            <input type="text" name="phone" class="form-control" id="" >
                        </div>
                        {{-- Error Exception jika Biodata dikosongkan--}}
                        @if ($errors->has('phone'))
                            <div class='error' style="color: red">
                            {{$errors -> first('phone')}}
                            </div>                            
                        @endif

                        <div class="form-group">
                            <label for="">
                                Website
                            </label>
                            <input type="text" name="website" class="form-control" id="" >
                        </div>
                        {{-- Error Exception jika Website dikosongkan--}}
                        @if ($errors->has('website'))
                            <div class='error' style="color: red">
                            {{$errors -> first('website')}}
                            </div>                            
                        @endif

                        <div class="form-group">
                            <label for="">
                                Slogan
                            </label>
                            <input type="text" name="slogan" class="form-control" id="" >
                        </div>
                        {{-- Error Exception jika slogan dikosongkan--}}
                        @if ($errors->has('slogan'))
                            <div class='error' style="color: red">
                            {{$errors -> first('slogan')}}
                            </div>                            
                        @endif


                        <div class="form-group">
                            <label for="">
                                Description
                            </label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="3">
                                
                            </textarea>
                        </div>
                        {{-- Error Exception jika description dikosongkan--}}
                        @if ($errors->has('description'))
                            <div class='error' style="color: red">
                            {{$errors -> first('description')}}
                            </div>                            
                        @endif

                        <div class="form-group">
                            <button class="btn btn-success">Submit</button>
                        </div>
                        @if(Session::has('message'))  {{--Pesan yang keluar ketika berhasil diperbaharui--}}
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        

    </div>
</div>
@endsection
