<x-apps-layout>
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
    <div class="row g-5">
        <div class="col-md d-md-none d-lg-block d-lg-none d-xl-none">
            <div class="card ">
                <div class="card-body">
                    <p>ingin bercerita ??</p>
                    <p>cerita ga nambah beban ke orang lain kok</p>
                    <p>gasinnn aja <a href="/addstory">kesini</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-8 border-end">
            @if (session()->has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form class="mb-3" method="post" action="{{ route('addsuggestion') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
                    <div id="emailHelp" class="form-text">if you want to get a reply to this suggestion, you must
                        enter your email</div>
                </div>
                <div class="mb-3">
                    <label for="suggestion" class="form-label">Suggestion</label>
                    <input id="comment" type="hidden" name="suggestion">
                    <trix-editor input="comment"></trix-editor>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md">
            <x-rightside></x-rightside>
        </div>
    </div>
    @push('script')
        <script type="text/javascript" src="/dist/trix.js"></script>
        <script>
            document.addEventlistener('trix-file-accept', function(e) {
                e.preventDefault();
            })
        </script>
    @endpush
</x-apps-layout>
