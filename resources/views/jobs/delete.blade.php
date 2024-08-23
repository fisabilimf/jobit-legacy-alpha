@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Job Post</div>

                <div class="card-body">
                    @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                    @endif
                    <form action="{{route('jobs.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>
                        @if ($errors->has('title'))
                            <div class='error' style="color: red">
                            {{$errors -> first('title')}}
                            </div>                            
                        @endif

                        <div class="form-group">
                            <label for="">Roles</label>
                            <input type="text" name="roles" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Position</label>
                            <input type="text" name="position" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category" id="" class="form-control">
                                @foreach (App\Category::all() as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="type" id="" class="form-control">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Casual">Casual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="live">Live</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Application Deadline</label>
                            <input type="date" name="last_date" id="" class="form-control">
                        </div>
                        
                        <div class="py-3"></div>
                        <div class="form-group">
                            <button class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
