@extends('layouts.dashboard')

@section('title', 'Roles')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Roles</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('create', \App\Models\Role::class)
        <a href="/dashboard/roles/create" class="button">Add Role</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Role List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>						
                        <th>Title</th>
                        <th>Permissions</th>	
                        <th></th>					
                    </tr>
                    @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>						
                        <td>{{ $role->title }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                            <span class="badge">{{ $permission->title . " " }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('update', \App\Models\Role::class)
                            <a href="/dashboard/roles/{{ $role->id }}/edit" class="action-button-green">
                                Edit
                            </a>
                            @endcan
                            @can('delete', \App\Models\Role::class)
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Delete role?')">
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
                        <td colspan="4">No roles found</td>
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
