    <div class="col-md-8 border-end">
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
        @foreach ($story as $item)
            <article class="card mb-3">
                <div class="card-body">
                    <p class="blog-post-meta">{{ $item->created_at }}</p>
                    <div class="mb-3">
                        @isset($item->stories)

                            {!! Str::limit(html_entity_decode(strip_tags($item->stories)), 100, '...') !!}<a href="story/{{ $item->slug }}">[read complete]</a>
                        @endisset
                        @isset($item->voice)
                            <audio src=""></audio>
                        @endisset
                    </div>
                    <div class="mt-3">
                    @if (!is_null(Auth::id()))
                            @if (!is_null($item->saves->where('user_id',
                            Auth::id())->where('destination','story')->where('destination_id',$item->id)->first()))
                            <button type="button" wire:click="unsave('{{ $item->id }}','story')"
                                class="btn btn-primary bi bi-save" title="save this story"></button>
                            @else
                                <button type="button" wire:click="addsave('{{ $item->id }}','story')"
                                    class="btn btn-outline-primary bi bi-save" title="save this story"></button>
                            @endif
                    @else
                        <button type="button" wire:click="addsave('{{ $item->id }}','story')"
                            class="btn btn-outline-primary bi bi-save" title="save this story"></button>
                    @endif
                        <a href="story/{{ $item->slug }}" type="button" class="btn btn-outline-danger bx bxs-comment-detail"
                            title="comment this story"></a>
                        <i type="button" class="btn btn-outline-secondary bi bi-share" title="comment this story"></i>
                    </div>
                </div>
            </article>
    @endforeach
    </div>
