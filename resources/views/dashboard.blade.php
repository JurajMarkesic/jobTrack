@extends('layouts.app')

@section('content')
<div class="container">

        <div class="col-md-8 offset-md-2 mt-5">
            <div class="card">
                <h4 class="card-header">Listings</h4>

                <div class="card-body">
                    <listings></listings>
                </div>
            </div>
        </div>



        <div class="col-md-8 offset-md-2 mt-5 mb-5">
            <div class="card">
                <h4 class="card-header">Create a listing</h4>

                <div class="card-body">
                    <createlisting></createlisting>
                </div>
            </div>
        </div>

</div>
@endsection
