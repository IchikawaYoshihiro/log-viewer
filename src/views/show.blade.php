@extends('logviewer::layout')

@section('title', __('logviewer::message.show'))

@section('content')
<a href="{{ route('logviewer::index') }}" class="mr-2">{{ __('logviewer::message.back_to_top') }}</a>
<div class="form-inline float-right">
	<input type="text" id="search" class="form-control" placeholder="filter">
</div>
<hr>
<ul id="search-target">
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
<hr>
<p><a href="{{ route('logviewer::index') }}" class="btn btn-primary">{{ __('logviewer::message.back_to_top') }}</a></p>
@endsection

@section('script')
<script>
	$(function() {
		const $list = $('#search-target li')
		// cache for text search
		const cache = $list.toArray().map(n => n.innerText)
		const hideClassName = 'hide'

		const filterContentWithCache = function (word) {
			cache.forEach((text, index) => {
				const classList = $list[index].classList
				if (text.includes(word)) {
					classList.contains(hideClassName) && classList.remove(hideClassName)
				} else {
					!classList.contains(hideClassName) && classList.add(hideClassName)
				}
			})
		}

		const $search = $('#search')
		$search.on('input', function() {
			filterContentWithCache(this.value)
		})
	})
</script>
@endsection
