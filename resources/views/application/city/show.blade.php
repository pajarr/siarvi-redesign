@extends('layout.app')

@section('main')
    <section class="section">
        <div class="section-header">
        <h1>City</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Show City</h2>
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
                    <form action="{{ route('application.city.update', [$city->id]) }}" method="PUT">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <sup style="color: red">*</sup></label>
                                    <input type="text" name="name" value="{{ old('name', $city->name) }}" class="form-control">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Province <sup style="color: red">*</sup></label>
                                    <select name="province" id="" class="form-control">
                                        <option value="">Select province</option>
                                        @if ($provinces->count() > 0)
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" @if ($city->province_id == $province->id) selected @endif>{{ $province->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('province')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Place Code <sup style="color: red">*</sup></label>
                                    <input type="text" name="place_code" value="{{ old('place_code', $city->place_code) }}" class="form-control">
                                    @error('place_code')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Latitude </label>
                                    <input type="text" name="latitude" value="{{ old('latitude', $city->latitude) }}" class="form-control">
                                    @error('latitude')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" value="{{ old('longitude', $city->longitude) }}" class="form-control">
                                    @error('longitude')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('application.city.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection