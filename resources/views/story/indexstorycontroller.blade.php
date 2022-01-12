 @extends('layouts.apps')
 @section('title', 'for your mental health')
 @section('main')
     @livewire('action.input-story')
     @livewire('story.indexstory')
 @endsection
 @section('side-content')
     <x-side-blog>

     </x-side-blog>
 @endsection
