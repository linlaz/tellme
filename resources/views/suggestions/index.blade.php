 @extends('layouts.apps')
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
 @section('main')
     <div class="card p-2">

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
             <button type="submit" class="btn btn-primary d-flex justify-content-end">Submit</button>
         </form>
     </div>
 @endsection
 @section('side-content')
     <x-side-story>

     </x-side-story>
 @endsection
 @push('script')
     <script type="text/javascript" src="/dist/trix.js"></script>
     <script>
         document.addEventlistener('trix-file-accept', function(e) {
             e.preventDefault();
         })
     </script>
 @endpush
