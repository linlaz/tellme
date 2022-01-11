<x-app-layout>

    @if ($errors->any())
        <div class="alert alert-danger my-1">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('editblogs') }}" method="POST">
        <input type="hidden" name="id" value="{{ $blog->id }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Form</h5>
                <form>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Title Blog</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="inputText" value="{{ $blog->title }}">
                            @error('title')
                                <div class="alert alert-danger my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10  @error('title') is-invalid @enderror">
                            <select class="js-example-basic-single form-select" aria-label="Default select example"
                                id="category" name="name">
                                @foreach ($category as $item)
                                    <option value="{{ $item->slug }}" @if ($blog->category_id == $item->id) selected @endif>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('title')
                            <div class="alert alert-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">subjek</label>
                        <div class="col-sm-10">
                            <textarea class="tinymce-editor" name="text">{{ $blog->text }}</textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>

    </form>
</x-app-layout>
