<div>
    @if (session()->has('mustlogin'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('mustlogin') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <article class="blog-post p-3">
        <h1 class="mt-4">{{ $blog->title }}</h1>
        <p class="blog-post-meta">{{ $blog->created_at }} | <a
                href="/blogs?category={{ $blog->category->slug }}">{{ $blog->category->name }}</a> </p>
        <div class="mb-5">
            <img src="https://source.unsplash.com/1600x900/?{{ $blog->category->name }},{{ $blog->title }},random"
                class="img-fluid mb-3" alt="">
            {!! $blog->text !!}
        </div>
        <div>

            @auth
                @if (!is_null($blog->saves->where('user_id',
                Auth::id())->where('destination','blog')->where('destination_id',$blog->id)->first()))
                <button type="button" wire:click="unsave('{{ $blog->id }}','blog')" class="btn btn-primary bi bi-save"
                    title="unsave this blog"></button>
                @else
                <button type="button" wire:click="addsave('{{ $blog->id }}','blog')"
                    class="btn btn-outline-primary bi bi-save" title="unsave this blog"></button>
                @endif
            @endauth

            @guest
                <button type="button" wire:click="addsave('{{ $blog->id }}','blog')"
                    class="btn btn-outline-primary bi bi-save" title="save this blog"></button>
            @endguest


            <i type="button" class="btn btn-outline-secondary bi bi-share"
                            data-clipboard-text="http://tellme.test/blogs/{{ $blog->slug }}" title="share this story"
                            onclick="alert('this link copied for you')"></i>
        </div>
    </article>
</div>
