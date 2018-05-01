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
		const $search = $('#search')

		// cache for text search
		const cache = $list.toArray().map(n => n.innerText)
		const filterContent = function (word) {
			cache.forEach((text, index) => {
				if (text.includes(word)) {
					$list[index].classList.remove('hide')
				} else {
					$list[index].classList.add('hide')
				}
			})
		}

		$search.on('input', function() {
			filterContent(this.value)
		})
	})
</script>
@endsection
