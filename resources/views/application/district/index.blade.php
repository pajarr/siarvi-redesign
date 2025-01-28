@extends('layout.app')

@section('main')
    <section class="section">
        <div class="section-header">
        <h1>District</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">District list</h2>
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
                <div class="card-header">
                  <h4>Simple Table</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('application.district.create') }}" class="btn btn-primary mb-3">Create</a>
                  <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Place Code</th>
                              <th>Province</th>
                              <th>City</th>
                              <th>Name</th>
                              <th>Longitude</th>
                              <th>Latitude</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($districts->count() <= 0)
                                <tr>
                                    <td colspan="7" class="text-center">No data districts available.</td>
                                </tr>
                            @else
                                @foreach ($districts as $district)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $district->place_code ?? '-' }}</td>
                                        <td>{{ optional($district->province)->name ?? '-' }}</td>
                                        <td>{{ optional($district->city)->name ?? '-' }}</td>
                                        <td>{{ $district->name ?? '-' }}</td>
                                        <td>{{ $district->longitude ?? '-' }}</td>
                                        <td>{{ $district->latitude ?? '-'}}</td>
                                        <td>
                                            <a href="{{ route('application.district.show', $district->id) }}" class="btn btn-primary">Show</a>
                                            <a href="{{ route('application.district.destroy', $district->id) }}" onclick="return confirm('Are you sure you want to delete this district?')" class="btn btn-danger">Delete</a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{ $districts->links() }}
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection