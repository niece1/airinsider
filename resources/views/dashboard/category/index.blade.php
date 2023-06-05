@extends('layouts.dashboard')

@section('title', 'Categories')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Categories</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('create', \App\Models\Category::class)
        <a href="/dashboard/categories/create" class="button">Add Category</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Category List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>						
                        <th>Title</th>	
                        <th></th>					
                    </tr>
                    @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>						
                        <td>{{ $category->title }}</td>						
                        <td>
                            @can('update', \App\Models\Category::class)
                            <a href="/dashboard/categories/{{ $category->id }}/edit" class="action-button-green">
                                Edit
                            </a>
                            @endcan
                            @can('delete', \App\Models\Category::class)
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete category?')">
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
                        <td colspan="3">No categories found</td>
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
