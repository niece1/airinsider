@extends('layouts.dashboard')

@section('title', 'Subscription List')

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>Subscription List</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">
		<a href="{{ route('export.csv') }}" class="button">Csv</a>
		<a href="{{ route('export.excel') }}" class="back">Excel</a>
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
							<form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="post">
								@method('DELETE')
								@csrf
								<button type="submit" class="action-button-red" onsubmit="return confirm('Delete subscription?')">Delete</button>
							</form>
						</td>
					</tr>				
					@endforeach
				</table>

			</div>
		</div>
	</div>

</section>

<section class="news-pagination">
	<div class="news-pagination-wrapper">
		{{ $subscriptions->links() }}
	</div>
</section>

@endsection