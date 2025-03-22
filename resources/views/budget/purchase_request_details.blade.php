@extends('layouts.app')

@section('title', 'Purchase Requests')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3 align-items-center">
            <div class="col-auto">
                <h1 class="mb-0">Purchase Requests Details</h1>
            </div>


        </div>
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                     
                        {{ $purchaseRequest }}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
