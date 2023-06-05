@extends('layouts.dashboard')

@section('title', 'Subscriptions')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Subscriptions</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('export', \App\Models\Subscription::class)
        <a href="{{ route('export.csv') }}" class="button">Csv</a>
        <a href="{{ route('export.excel') }}" class="back">Excel</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Subscription List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Confirmed</th>
                        <th></th>
                    </tr>
                    @forelse ($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->email }}</td>
                        <td>{{ $subscription->if_confirmed }}</td>
                        <td>
                            @can('delete', \App\Models\Subscription::class)
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
                    @empty
                    <tr>
                        <td colspan="3">No subscriptions found</td>
                    </tr>
                    @endforelse
                </table>
                <!-- /.Table -->
            </div>
        </div>
    </div>
</section>
<!-- /.Dashboard -->

<!-- Pagination -->
<section class="news-pagination">
    <div class="news-pagination-wrapper">{{ $subscriptions->links('vendor.pagination.default') }}</div>
</section>
<!-- /.Pagination -->

@endsection
