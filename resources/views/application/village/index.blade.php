@extends('layout.app')

@section('main')
    <section class="section">
        <div class="section-header">
        <h1>Village</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Village list</h2>
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
                    <a href="{{ route('application.village.create') }}" class="btn btn-primary mb-3">Create</a>
                  <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Place Code</th>
                              <th>Province</th>
                              <th>City</th>
                              <th>District</th>
                              <th>Name</th>
                              <th>Longitude</th>
                              <th>Latitude</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($villages->count() <= 0)
                                <tr>
                                    <td colspan="7" class="text-center">No data villages available.</td>
                                </tr>
                            @else
                                @foreach ($villages as $village)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $village->place_code ?? '-' }}</td>
                                        <td>{{ optional($village->province)->name ?? '-' }}</td>
                                        <td>{{ optional($village->city)->name ?? '-' }}</td>
                                        <td>{{ optional($village->district)->name ?? '-' }}</td>
                                        <td>{{ $village->name ?? '-' }}</td>
                                        <td>{{ $village->longitude ?? '-' }}</td>
                                        <td>{{ $village->latitude ?? '-'}}</td>
                                        <td>
                                            <a href="{{ route('application.village.show', $village->id) }}" class="btn btn-primary">Show</a>
                                            <a href="{{ route('application.village.destroy', $village->id) }}" onclick="return confirm('Are you sure you want to delete this village?')" class="btn btn-danger">Delete</a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{ $villages->links() }}
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection