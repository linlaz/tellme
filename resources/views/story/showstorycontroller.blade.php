 @extends('layouts.apps')

 @section('main')
     @livewire('story.showstory',['slug' => $slug])
 @endsection
 @section('side-content')
     <x-side-blog>

     </x-side-blog>
 @endsection
