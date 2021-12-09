@push('style')
    <link rel="stylesheet" type="text/css" href="/dist/trix.css">
    <style>
        trix-toolbar .trix-button-group--file-tools {
            display: none;
        }

        trix-toolbar .trix-button-group--block-tools {
            display: none;
        }

        trix-toolbar .trix-button-group--text-tools {
            display: none;
        }
        
        trix-toolbar .trix-button-group--history-tools {
            display: none;
        }
    </style>
@endpush
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
            <i type="button" class="btn btn-outline-secondary bi bi-share"
                data-clipboard-text="http://tellme.test/story/{{ $story->slug }}" title="share this story"
                onclick="alert('this link copied for you')"></i>
        </div>
    </article>
    @if ($formcomment == 'active')
        <div class="alert alert-warning" role="alert">
            <ol>
                        <li>jangan menyebutkan identitas diri anda <strong> bila anda tidak ingin di ketahui</strong>
                        </li>
                        <li>jangan pernah langsung menghakimi apa yang kamu tidak tahu sepenuhnya</li>
                        <li>Posisikan dirimu berada di kondisi sang penulis</li>
                    </ol>
        </div>
        <form class="mb-3" action="POST" wire:submit.prevent='savecomment'>
            <div class="mb-3" wire:model.debounce.350ms="comment" wire:ignore>
                <input id="comment" type="hidden" name="comment">
                <trix-editor input="comment"></trix-editor>
            </div>
            @error('comment')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
                     <button type="submit" class="btn btn-primary">send</button>
            <button type="button" wire:click="cancelcomment" class="btn btn-danger">cancel</button>
        </form>
    @endif

    @foreach ($story->comment as $item)
        <div class="card px-1">
            <div class="card-body">
                <div class="comment-footer">
                    <span class="date">{{ $item->created_at }}</span>
                    @auth
                        @if (Auth::user()->id == $story->user_id || Auth::user()->hasPermissionTo('delete-comment'))
                            <i onclick="confirm('Are you sure you want to delete this comment ?') || event.stopImmediatePropagation()"
                                wire:click="deletecomment('{{ $item->id }}')" type="button"
                                class="btn btn-danger ri-delete-bin-5-fill" title="delete this comment"></i>
                        @endif
                    @endauth
                </div>
                {!! $item->subject !!}
            </div>
        </div>
    @endforeach
</div>
@push('script')
    <script type="text/javascript" src="/dist/trix.js"></script>
    <script>
        document.addEventlistener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>
@endpush
