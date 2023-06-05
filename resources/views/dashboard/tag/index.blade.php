@extends('layouts.dashboard')

@section('title', 'Tags')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Tags</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('create', \App\Models\Tag::class)
        <a href="/dashboard/tags/create" class="button">Add Tag</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Tag List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>						
                        <th>Title</th>	
                        <th></th>					
                    </tr>
                    @forelse ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>						
                        <td>{{ $tag->title }}</td>						
                        <td>
                            @can('update', \App\Models\Tag::class)
                            <a href="/dashboard/tags/{{ $tag->id }}/edit" class="action-button-green">
                                Edit
                            </a>
                            @endcan
                            @can('delete', \App\Models\Tag::class)
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Delete tag?')">
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
                        <td colspan="3">No tags found</td>
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
