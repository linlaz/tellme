<div>
    @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <article class="blog-post p-3 border-bottom">
        <p class="blog-post-meta">{{ $story->created_at }}</p>
        <div class="mb-5">
            @isset($story->stories)
                {!! $story->stories !!}
            @endisset
        </div>
        <div>
            @if (!is_null(Auth::id()))
                            @if (!is_null($story->saves->where('user_id',
                            Auth::id())->where('destination','story')->where('destination_id',$story->id)->first()))
                            <button type="button" wire:click="unsave('{{ $story->id }}','story')"
                                class="btn btn-primary bi bi-save" title="save this story"></button>
                            @else
                                <button type="button" wire:click="addsave('{{ $story->id }}','story')"
                                    class="btn btn-outline-primary bi bi-save" title="save this story"></button>
                            @endif
                    @else
                        <button type="button" wire:click="addsave('{{ $story->id }}','story')"
                            class="btn btn-outline-primary bi bi-save" title="save this story"></button>
                    @endif
            <button type="button" wire:click="comment('active')" class="btn btn-outline-danger bx bxs-comment-detail"
                title="comment this story"></button>
            <button type="button" class="btn btn-outline-secondary bi bi-share" title="share this story"></button>

        </div>
    </article>
    @if ($formcomment == 'active')
        <form action="POST" wire:submit.prevent="savecomment">
             <input id="x" type="hidden" name="content" value="{{ $value }}">
            <trix-editor input="x"></trix-editor>
            <button type="submit">save comment</button>
        </form>
    @endif

    @foreach ($story->comment as $item)
        <div class="card px-1">
            <div class="card-body border-bottom">
                <div class="comment-footer">
                    <span class="date">{{ $item->created_at }}</span>
                </div>
                {{ $item->subject }}
            </div>
        </div>
    @endforeach
</div>

