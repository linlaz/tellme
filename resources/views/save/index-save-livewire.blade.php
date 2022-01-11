{{-- Care about people's approval and you will be their prisoner. --}}
@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Arvo&family=Rubik:wght@300&display=swap" rel="stylesheet">
@endpush
<div wire:loading.delay.class="opacity-50" class="py-1">
    @if (session()->has('success'))
        <x-session-success></x-session-success>
    @endif
    @if (session()->has('failed'))
        <x-session-failed></x-session-failed>
    @endif
    @if (count($save) == 0)
        <div class="alert alert-danger text-center my-3" role="alert">
            <h1> you don't save enythings</h1>
        </div>
    @endif
    @foreach ($save as $item)
        <div class="card my-3" style="font-family: 'Arvo', serif ;">
            <div class="card-body" style="transform: rotate(0);">
                <h5 class="card-title">Saved at {{ $item->created_at }} | {{ $item->destination }}
                </h5>
                @if ($item->destination == 'story')
                    @php
                        $check = $item->story->publish == '1';
                    @endphp
                    @if ($check)
                        @isset($item->story->stories)
                            {!! Str::limit(html_entity_decode(strip_tags($item->story->stories)), 250, '...') !!}
                            <a href="/story/{{ $item->story->slug }}">[read
                                complete]</a>
                            <a href="/{{ $item->destination }}/{{ $item->story->slug }}" class="stretched-link"></a>
                        @endisset
                    @else
                        <div class="alert alert-danger" role="alert">
                            This {{ $item->destination }} is archived
                        </div>
                    @endif

                @endif
                @if ($item->destination == 'blog')
                    @php
                        $check = $item->blog->publish == '1';
                    @endphp
                    @if ($check)
                        @isset($item->blog->text)
                            {!! Str::limit(html_entity_decode(strip_tags($item->blog->text)), 250, '...') !!}
                            <a href="/blog/read/{{ $item->blog->slug }}">[read
                                complete]</a>
                            <a href="/{{ $item->destination }}/read/{{ $item->blog->slug }}" class="stretched-link"></a>
                        @endisset
                    @else
                        <div class="alert alert-danger" role="alert">
                            This {{ $item->destination }} is archived
                        </div>
                    @endif
                @endif

            </div>
            <div class="btn btn-danger w-100">
                <p type="button"
                    onclick="confirm('Are you sure you want to delete this saved ?') || event.stopImmediatePropagation()"
                    wire:click="delete('{{ Crypt::encrypt($item->id) }}')" class="card-title">delete</p>
            </div>
        </div>
    @endforeach
    {{ $save->links() }}
</div>
@push('script')
    <script>
        window.addEventListener('successdelete', event => {
            alert('deleted success for saved');
        })
    </script>
@endpush
