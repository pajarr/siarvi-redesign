@extends('layout.app')

@section('main')
    <section class="section">
        <div class="section-header">
        <h1>District</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create District</h2>
            <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p>

            @if (Session::has('success_message'))
                <div class="alert alert-success alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Success</div>
                        {{ Session::get('success_message') }}
                    </div>
                </div>
            @endif

            @if (Session::has('error_message'))
                <div class="alert alert-danger alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Error</div>
                        {{ Session::get('error_message') }}
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('application.role.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name <sup style="color: red">*</sup></label>
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('application.province.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection