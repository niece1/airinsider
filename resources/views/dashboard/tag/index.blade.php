@extends('layouts.dashboard')

@section('title', 'Tags')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Tags</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('tag_create')
        <a href="/dashboard/tags/create" class="button">Add Tag</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Tag List</h5>
            </div>
            <div class="well-content">
                <table>
                    <tr>
                        <th>ID</th>						
                        <th>Title</th>	
                        <th></th>					
                    </tr>
                    @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>						
                        <td>{{ $tag->title }}</td>						
                        <td>
                            @can('tag_edit')
                            <a href="/dashboard/tags/{{ $tag->id }}/edit" class="action-button-green">
                                Edit
                            </a>
                            @endcan
                            @can('tag_delete')
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
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>

@endsection