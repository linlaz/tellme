<div>
    @if (count($save) == 0)
        <div class="alert alert-primary" role="alert">
            you don't save enythings
        </div>
    @endif
    @foreach ($save as $item)
        <div class="card">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-body" style="transform: rotate(0);">
                        <h5 class="card-title">Saved at {{ $item->created_at }} | {{ $item->destination }}
                        </h5>
                        @if ($item->destination == 'story')
                            @isset($item->story->stories)
                                {!! Str::limit(html_entity_decode(strip_tags($item->story->stories)), 250, '...') !!}
                                <a href="/story/{{ $item->story->slug }}">[read
                                    complete]</a>
                                <a href="/{{ $item->destination }}/{{ $item->story->slug }}" class="stretched-link"></a>
                            @endisset
                        @endif
                        @if ($item->destination == 'blog')
                            @isset($item->blog->text)
                                {!! Str::limit(html_entity_decode(strip_tags($item->blog->text)), 250, '...') !!}
                                <a href="/blogs/{{ $item->blog->slug }}">[read
                                    complete]</a>
                                <a href="/{{ $item->destination }}s/{{ $item->blog->slug }}" class="stretched-link"></a>
                            @endisset
                        @endif

                    </div>
                </div>
                <div class="col-lg-2 btn btn-danger">
                    <p type="button" wire:click="delete('{{ $item->destination }}','{{ $item->destination_id }}')"
                        class="card-title">delete</p>
                </div>
            </div>
        </div>
    @endforeach
    {{ $save->links() }}
</div>
