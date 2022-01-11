 @extends('layouts.apps')
 @section('main')
     <div class="mt-4 ms-4">
         <h2>Your Story</h2>
     </div>
    @livewire('profile.index-profile-livewire')
 @endsection
 @section('side-content')
     <x-side-blog>

     </x-side-blog>
 @endsection
