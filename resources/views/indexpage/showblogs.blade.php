<x-apps-layout>
    {{-- Success is as dangerous as failure. --}}
    <div class="row g-5 mt-3">
        <div class="col-md-9 m-auto ">
            <article class="blog-post p-3">
                <h1 class="mt-4">{{ $blog->title }}</h1>
                <p class="blog-post-meta">{{ $blog->created_at }} | <a
                        href="/blogs?category={{ $blog->category->slug }}">{{ $blog->category->name }}</a> </p>
                <div class="mb-5">
                    <img src="https://source.unsplash.com/1600x900/?{{ $blog->category->name }}" class="img-fluid mb-3"
                        alt="">
                    {!! $blog->text !!}
                </div>
                <div>
                    @if (session()->has('mustlogin'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('mustlogin') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                   @if (!is_null(Auth::id()))
                            @if (!is_null($blog->saves->where('user_id',
                            Auth::id())->where('destination','blog')->where('destination_id',$blog->id)->first()))
                            <button type="button" wire:click="unsave('{{ $blog->id }}','blog')"
                                class="btn btn-primary bi bi-save" title="save this blog"></button>
                            @else
                                <button type="button" wire:click="addsave('{{ $blog->id }}','blog')"
                                    class="btn btn-outline-primary bi bi-save" title="save this blog"></button>
                            @endif
                    @else
                        <button type="button" wire:click="addsave('{{ $blog->id }}','blog')"
                            class="btn btn-outline-primary bi bi-save" title="save this blog"></button>
                    @endif
                    <i type="button" class="btn btn-outline-secondary bi bi-share" title="share this blog"></i>
                </div>
            </article>
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Read More
            </h3>
            {{-- @foreach ($next as $item)
                <article class="blog-post mb-3">
                    <h3 class="blog-post-title">
                        {{ $item->title }}
                    </h3>
                    <p class="blog-post-meta">{{ $item->created_at }} | <a
                            href="blogs?category={{ $item->category->slug }}">{{ $item->category->name }}</a></p>
                    <div class="mb-3">
                        @isset($item->text)
                            {!! Str::limit(strip_tags($item->text), 200, '...') !!}<a href="/blogs/{{ $item->slug }}">[read complete]</a>
                        @endisset
                    </div>
                    <div class="mt-3">
                        <i type="button" wire:click="addlist('{{ $item->id }}','story')"
                            class="btn btn-outline-primary bi bi-save" title="save this story"></i>

                        <i type="button" class="btn btn-outline-secondary bi bi-share" title="comment this story"></i>
                    </div>
                </article>
                <hr>
            @endforeach --}}
        </div>
    </div>


</x-apps-layout>
