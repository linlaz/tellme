 @extends('layouts.apps')
 @section('main')
    @livewire('blog.show-by-category-livewire',['slug' => $slug])
 @endsection
 @section('side-content')
     <x-side-story>
     </x-side-story>
 @endsection