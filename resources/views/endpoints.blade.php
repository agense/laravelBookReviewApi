@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Api Endpoints</h1>

            <!--Authentication Routes-->
            @include('partials/AuthEndpoints')
            <!--End Of Authentication Routes-->
            
            <!--Genre Routes-->
            @include('partials/GenreEndpoints')
            <!--End Of Genre Routes-->

            <!--Author Routes-->
            @include('partials/AuthorEndpoints')
            <!--End Of Author Routes-->

            <!--Book Routes-->
            @include('partials/BookEndpoints')
            <!--End Of Book Routes-->

            <!--Reviews Routes-->
            @include('partials/ReviewEndpoints')
            <!--End Of Reviews Routes-->

            <!--User Account Management Routes-->
            @include('partials/UserAccountEndpoints')
            <!--End Of User Account Management Routes-->

            <!--Statistics Routes-->
            @include('partials/StatisticsEndpoints')
            <!--End Of Statistics Routes-->
        </div>
    </div>
</div>
@endsection