@extends('layout.app')

@section('main')
    <section class="section">
        <div class="section-header">
        <h1>Users</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Users list</h2>
            <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p>

            <div class="card">
                <div class="card-header">
                  <h4>Simple Table</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('application.users.create') }}" class="btn btn-primary mb-3">Create</a>
                  <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Email</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() <= 0)
                                <tr>
                                    <td colspan="5" class="text-center">No data users available.</td>
                                </tr>
                            @else
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><a href="#" class="btn btn-primary">Show</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{ $users->links() }}
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection