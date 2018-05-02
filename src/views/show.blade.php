@extends('logviewer::layout')

@section('title', __('logviewer::message.show', ['filename' => $filename]))

@section('content')
<a href="{{ route('logviewer::index') }}" class="btn btn-primary">{{ __('logviewer::message.back_to_top') }}</a>
<div class="form-inline float-right">
    <input type="text" id="search" class="form-control" placeholder="filter">
</div>
<hr>
<ul id="search-list">
@forelse ($logs as $log)
    <li>
        <small>
            [{{ $log->date }}]
            <span class="badge badge-env badge-{{ $log->envClass() }}">{{ $log->env }}</span>
            <span class="badge badge-level badge-{{ $log->levelClass() }}">{{ $log->level }}</span>
        </small>
        {{ $log->message }}
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
    const list = [...document.querySelectorAll('#search-list li')]
    const cache = list.map(n => n.innerText)
    const hideClassName = 'd-none'

    const filterContentWithCache = function (word) {
        cache.forEach((text, index) => {
            const classList = list[index].classList
            if (text.includes(word)) {
                if (classList.contains(hideClassName)) {
                    classList.remove(hideClassName)
                }
            }
            else {
                if (!classList.contains(hideClassName)) {
                    classList.add(hideClassName)
                }
            }
        })
    }

    const search = document.querySelector('#search')
    search.addEventListener('input', function(){
        filterContentWithCache(this.value)
    })
</script>
@endsection
