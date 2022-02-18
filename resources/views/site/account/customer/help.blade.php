@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.customer.help')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="hero-body">
                        <div class="row box_account">
                            <div class="col-md-12">

                               <customer-page-help></customer-page-help>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
