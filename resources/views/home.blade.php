@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>Welcome</h3>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <p class="card-text">Hello {{ Auth::user()->firstname }}!</p>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
