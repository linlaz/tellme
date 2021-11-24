<x-app-layout>
    <form action="{{ route('editstories') }}" method="POST">
        <input type="hidden" name="id" value="{{ $story->id }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Quill Editor Default</h5>
                
                <input id="story" type="hidden" value=" {{ $story->stories }}" name="story">
                <trix-editor input="story"></trix-editor>
            </div>
        </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">edit story</button>
        </div>

    </form>
</x-app-layout>
