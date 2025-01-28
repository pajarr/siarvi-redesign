@extends('layout.app')

@section('main')
    <section class="section">
        <div class="section-header">
        <h1>Province</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Province list</h2>
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
                    <a href="{{ route('application.province.create') }}" class="btn btn-primary mb-3">Create</a>
                  <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Place Code</th>
                              <th>Name</th>
                              <th>Longitude</th>
                              <th>Latitude</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($provinces->count() <= 0)
                                <tr>
                                    <td colspan="5" class="text-center">No data provinces available.</td>
                                </tr>
                            @else
                                @foreach ($provinces as $province)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $province->place_code ?? '-' }}</td>
                                        <td>{{ $province->name ?? '-' }}</td>
                                        <td>{{ $province->longitude ?? '-' }}</td>
                                        <td>{{ $province->latitude ?? '-'}}</td>
                                        <td>
                                            <a href="{{ route('application.province.show', $province->id) }}" class="btn btn-primary">Show</a>
                                            <a href="{{ route('application.province.destroy', $province->id) }}" onclick="return confirm('Are you sure you want to delete this province?')" class="btn btn-danger">Delete</a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{ $provinces->links() }}
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection