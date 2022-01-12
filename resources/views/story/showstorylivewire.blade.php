{{-- The Master doesn't talk, he acts. --}}
{{-- @extends('layouts.apps')
@section('main')
    @livewire('story.showstory',['slug' => $slug])

 
@endsection
@section('side-content')
    <x-side-blog>

    </x-side-blog>
@endsection --}}
{{-- @section('main')
    

 
@endsection --}}
@section('title', "{{ Str::limit(html_entity_decode(strip_tags($story->stories)), 100) }}")
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
<div class="my-3">
    
    @if (session()->has('success'))
        <x-session-success></x-session-success>
    @endif
    @if (session()->has('failed'))
        <x-session-failed></x-session-failed>
    @endif
    <article class="card mb-3 border-top fs-5">
        <div class="card-body">
            <div class="position-relative">
                <p class="blog-post-meta">{{ $story->created_at }}</p>
                <div class="mb-3" style="font-family: Helvetica ;">
                    @isset($story->stories)
                        {!! $story->stories !!}
                    @endisset
                </div>
            </div>
            <hr>
            <div>
                <div class="mt-3">
                    <div class="row">
                        <div class="col text-center">
                            @php
                                $totalsave = $story->saves
                                    ->where('destination', 'story')
                                    ->where('destination_id', $story->id)
                                    ->count();
                            @endphp
                            @auth
                                @if (!is_null($story->saves->where('user_id', Auth::id())->where('destination',
                                'story')->where('destination_id', $story->id)->first()))
                                <button type="button" class="btn btn-primary"
                                    wire:click="unsave('{{ Crypt::encrypt($story->id) }}','story')" title="unsave this story"><i
                                        class="bi bi-save"></i>
                                    @if ($totalsave != 0)
                                        {{ $totalsave }}
                                    @endif
                                </button>
                            @else
                                <button type="button" class="btn btn-outline-primary"
                                    wire:click="addsave('{{ Crypt::encrypt($story->id) }}','story')" title="save this story"><i
                                        class="bi bi-save"></i>
                                    @if ($totalsave != 0)
                                        {{ $totalsave }}
                                    @endif
                                </button>
                                @endif
                            @endauth
                            @guest
                                <button type="button" class="btn btn-outline-primary"
                                    wire:click="addsave('{{ Crypt::encrypt($story->id) }}','story')" title="save this story"><i
                                        class="bi bi-save"></i>
                                </button>
                            @endguest
                        </div>
                        @php
                            $totalcomment = $story->comment->where('story_id', $story->id)->count();
                        @endphp
                        <div class="col text-center">
                            <a type="button" class="btn btn-outline-danger"
                                title="comment this story"><i class="ri-chat-smile-line"></i> @if ($totalcomment != 0) {{ $totalcomment }}  @endif
                            </a>
                        </div>
                        <div class="col text-center">
                            <button type="button" class="btn btn-outline-secondary"
                                data-clipboard-text="http://tellme.test/story/{{ $story->slug }}"
                                title="share this story" onclick="alert('this link copied for you')"><i
                                    class="bi bi-share"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="mb-3">
        <textarea class="form-control" name="comment" wire:model.debounce.350ms="comment"
            placeholder="komentar dapat menyebabkan hal baik maupun buruk" id="comment"
            style="min-height:100px"></textarea>
    </div>
    @error('comment')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
    @enderror
    <div class="d-flex mb-3 justify-content-end mt-3">
        <button wire:click="sendcomment('{{ Crypt::encrypt($story->id) }}')" class="btn xl btn-primary">Send</button>
    </div>

    <div class="card">
        @foreach ($story->comment as $comment)
            @if ($comment === null)
                <div class="alert alert-warning" role="alert">
                    comment is null
                </div>
            @endif
            <div class="card-body border-bottom fs-5" id="comment{{ $loop->index }}">
                <div class="blog-post-meta">
                    Created at {{ $comment->created_at->diffForHumans() }}
                </div>
                <div class="" style="font-family: cursive;">
                    {!! $comment->subject !!}
                </div>
                <div class="d-flex justify-content-end mt-3 mx-2">
                    @auth
                        @if (Auth::user()->id == $story->user_id || Auth::user()->hasPermissionTo('delete-comment'))
                            <button
                                onclick="confirm('Are you sure you want to delete this comment ?') || event.stopImmediatePropagation()"
                                wire:click="deletecomment('{{ Crypt::encrypt($comment->id) }}')"
                                class=" ri-delete-bin-5-fill btn-lg btn-danger"></button>
                        @endif
                    @endauth
                    <button type="button" class="btn btn-outline-secondary mx-3"
                        data-clipboard-text="http://tellme.test/story/{{ $story->slug }}/#comment{{ $loop->index }}"
                        title="share this story" onclick="alert('this link copied for you')"><i
                            class="bi bi-share"></i>
                    </button>
                </div>
            </div>
        @endforeach

    </div>
</div>


@push('script')
    <script type="text/javascript" src="/dist/trix.js"></script>
    <script>
        window.addEventListener('successdelete', event => {
            alert('deleted success for comment');
        })
        // Livewire.emit('success')
    </script>
    {{-- <script>
        document.addEventlistener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script> --}}
@endpush
