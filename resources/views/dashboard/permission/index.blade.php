@extends('layouts.dashboard')

@section('title', 'Permissions')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Permissions</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('permission_create')
        <a href="/dashboard/permissions/create" class="button">Add Permission</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Permission List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>						
                        <th>Title</th>	
                        <th></th>					
                    </tr>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>						
                        <td>{{ $permission->title }}</td>						
                        <td>
                            @can('permission_delete')
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Delete permission?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="action-button-red">
                                    Delete
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>				
                    @endforeach
                </table>
                <!-- /.Table -->
            </div>
        </div>
    </div>
</section>
<!-- /.Dashboard -->

@endsection
