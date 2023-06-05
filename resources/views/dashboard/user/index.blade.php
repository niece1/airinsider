@extends('layouts.dashboard')

@section('title', 'Users')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Users</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        <div class="well">
            <div class="well-title">
                <h5>User List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Last login</th>
                        <th>Provider</th>
                        <th>IP adress</th>
                        <th>Created</th>
                        <th>Roles</th>
                        <th></th>
                    </tr>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->last_login_at }}</td>
                        <td>
                            @if ($user->provider)
                            {{ $user->provider }}
                            @endif
                        </td>
                        <td>{{ $user->last_login_ip_address }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                            {{ $role->title . " " }}
                            @endforeach
                        </td>
                        <td>
                            @can('update', \App\Models\User::class)
                            <a href="/dashboard/users/{{ $user->id }}/edit" class="action-button-green">
                                Edit
                            </a>
                            @endcan
                            @can('delete', \App\Models\User::class)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete user?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="action-button-red">
                                    Delete
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">No users found</td>
                    </tr>
                    @endforelse
                </table>
                <!-- /.Table -->
            </div>
        </div>
    </div>
</section>
<!-- /.Dashboard -->

@endsection
