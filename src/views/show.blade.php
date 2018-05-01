@extends('logviewer::layout')

@section('title', __('logviewer::message.show'))

@section('content')
<p><a href="{{ route('logviewer::index') }}">{{ __('logviewer::message.back_to_top') }}</a></p>
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
		<li>{{ __('logviewer::message.no_logs') }}</li>
	@endforelse
	</ul>
@endsection