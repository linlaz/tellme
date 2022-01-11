i @extends('layouts.apps')
@section('main')
    @livewire('blog.show-blog-livewire',['slug' => $slug])
    <h1>READ MORE</h1>
    @foreach ($next as $item)
        <article class="card my-3 border-top fs-5" @if ($loop->last) id="last_record" @endif style="font-family: 'Arvo', serif ;">
            <div class="card-body">
                <p class="blog-post-meta">{{ $item->created_at->diffForHumans() }} | <a
                        href="/blog/category/{{ $item->category->slug }}">{{ $item->category->name }}</a> </p>
                <div class="position-relative">
                    <div class="title-blog mb-2">
                        <h3>{{ $item->title }}</h3>
                    </div>
                    <div class="banner-blog mb-3">
                        <img src="https://source.unsplash.com/1600x900/?{{ $item->category->name }},{{ $item->title }},random"
                            class="img-fluid" alt="...">
                    </div>
                    <div class="mb-3">
                        @isset($item->text)
                            <p> {!! Str::limit(html_entity_decode(strip_tags($item->text)), 100, '...') !!}<a href="/blog/read/{{ $item->slug }}">[read complete]</a></p>
                        @endisset
                        <a href="/blog/read/{{ $item->slug }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </article>
    @endforeach
@endsection
@section('side-content')
    <x-side-story>
    </x-side-story>
@endsection
