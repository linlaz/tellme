<div>
    {{-- The best athlete wants his opponent at his best. --}}
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
    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @foreach ($blog as $item)
        <article class="blog-post mb-3">
            <h3 class="blog-post-title">
                {{ $item->title }}
            </h3>
            <p class="blog-post-meta">{{ $item->created_at }} | <a
                    href="blogs?category={{ $item->category->slug }}">{{ $item->category->name }}</a></p>

            <div class="mb-3">
                @isset($item->text)
                    {!! Str::limit(strip_tags($item->text), 200, '...') !!}<a href="blogs/{{ $item->slug }}">[read complete]</a>
                @endisset
            </div>
            <div class="mt-3">
                 @if (!is_null(Auth::id()))
                            @if (!is_null($item->saves->where('user_id',
                            Auth::id())->where('destination','blog')->where('destination_id',$item->id)->first()))
                            <button type="button" wire:click="unsave('{{ $item->id }}','blog')"
                                class="btn btn-primary bi bi-save" title="save this blog"></button>
                            @else
                                <button type="button" wire:click="addsave('{{ $item->id }}','blog')"
                                    class="btn btn-outline-primary bi bi-save" title="save this blog"></button>
                            @endif
                    @else
                        <button type="button" wire:click="addsave('{{ $item->id }}','blog')"
                            class="btn btn-outline-primary bi bi-save" title="save this blog"></button>
                    @endif
    <i type="button" class="btn btn-outline-secondary bi bi-share" data-clipboard-text="http://tellme.test/blogs/{{ $item->slug }}"  title="comment this blog"
         onclick="alert('this link copied for you')"></i>
</div>
</article>
<hr>
@endforeach
</div>
{{ $blog->links() }}
