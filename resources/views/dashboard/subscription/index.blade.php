@extends('layouts.dashboard')

@section('title', 'Subscriptions')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Subscriptions</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('subscription_export')
        <a href="{{ route('export.csv') }}" class="button">Csv</a>
        <a href="{{ route('export.excel') }}" class="back">Excel</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Subscription List</h5>
            </div>
            <div class="well-content">
                <table>
                    <tr>
                        <th>ID</th>						
                        <th>Email</th>	
                        <th></th>					
                    </tr>
                    @foreach ($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>						
                        <td>{{ $subscription->email }}</td>						
                        <td>
                            @can('subscription_delete')
                            <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" onsubmit="return confirm('Delete subscription?')">
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

<section class="news-pagination">
    <div class="news-pagination-wrapper">{{ $subscriptions->links() }}</div>
</section>

@endsection
