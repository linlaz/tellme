{{-- The Master doesn't talk, he acts. --}}
{{-- Nothing in the world is as soft and yielding as water. --}}
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
<div class="card my-3 p-3 bg-danger-light">
    @if ($action == 'edit')
        <h4>Edit Story</h4>
    @endif
    {{-- <div wire:ignore.self>
        @if ($form == 'text')
            <div class="mb-3"  wire:model.debounce.350ms="story" wire:ignore.self>
                <input id="story" type="hidden" name="story" wire:ignore>
                <trix-editor input="story" wire:ignore
                    placeholder="Cerita itu ga nambahin beban ke orang lain kok, jadi kalo butuh cerita aja ya?">
                </trix-editor>
            </div>
            @error('story')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        @elseif ($form == 'mic')
            <div class="alert alert-danger my-2 text-center" role="alert">
                Sorry for tools mic can't access now.
            </div>
        @endif
    </div> --}}
    @if ($form == 'text')
        @if ($action != 'edit')
            <div class="mb-3" wire:model.debounce.350ms="story">
                <input id="story" type="hidden" name="story">
                <trix-editor input="story" wire:ignore
                    placeholder="Cerita itu ga nambahin beban ke orang lain kok, jadi kalo butuh cerita aja ya?">
                </trix-editor>
            </div>
        @else
            <textarea class="form-control" id="story" wire:model.debounce.350ms="story"
                style="height: 100px"></textarea>
        @endif
        @error('story')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
    @elseif ($form == 'mic')
        <div class="alert alert-danger my-2 text-center" role="alert">
            Sorry mic can't access now.
        </div>
    @endif
    <div class="d-flex justify-content-end mt-3">
        @if ($form == 'text')

            @if ($action == 'edit')
                <button wire:click="editstory" class="btn btn-primary">Save</button>
            @else
                <button type="button" wire:click="actionform('mic')" class="mx-3"><i
                        class="ri-mic-line"></i></button>
                <button wire:click="sendstory" class="btn btn-primary">Send</button>
            @endif

        @elseif ($form == 'mic')
            <button type="button" wire:click="actionform('text')" class="mx-3"><i
                    class="ri-text"></i></button>
        @endif

    </div>
    {{-- </form> --}}
</div>
@push('script')
    <script type="text/javascript" src="/dist/trix.js"></script>
    {{-- <script>
        document.addEventlistener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script> --}}
@endpush
