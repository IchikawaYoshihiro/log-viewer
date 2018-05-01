@extends('logviewer::layout')

@section('title', 'Show')

@section('content')
	<ul>
	@forelse ($logs as $log)
		<li>
			<small>
				<span>[{{ $log->date }}]</span>
				<span class="badge badge-{{ $log->envClass() }}">{{ $log->env }}</span>
				<span class="badge badge-{{ $log->levelClass() }}">{{ $log->level }}</span>
			</small>
			<span>{{ $log->message }}</span>
		</li>
	@empty
		<li>{{ __('logviewer::no_contents') }}</li>
	@endforelse
	</ul>
@endsection