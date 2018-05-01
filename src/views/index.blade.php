@extends('logviewer::layout')

@section('title', __('logviewer::message.top'))

@section('content')
	<ul>
	@forelse ($files as $file)
		<li><a href="{{ route('logviewer::show', $file) }}">{{ $file }}</a></li>
	@empty
		<li>{{ __('logviewer::message.no_files') }}</li>
	@endforelse
	</ul>
@endsection
