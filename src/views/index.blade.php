@extends('logviewer::layout')

@section('title', 'Index')

@section('content')
	<ul>
	@forelse ($files as $file)
		<li><a href="{{ route('logviewer::show', $file) }}">{{ $file }}</a></li>
	@empty
		<li>{{ __('logviewer::no_files') }}</li>
	@endforelse
	</ul>
@endsection