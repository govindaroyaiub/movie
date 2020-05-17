@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/upload" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" class="form-control-file" name="file"><br>
                    <button type="submit" class="form-control-user">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
