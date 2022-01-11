<x-app-layout>
    @can('add-blog')
        <a type="button" class="btn btn-info btn-lg" href="/dashboard/blog/create">
            <i class="bi bi-plus-lg"></i>
            Add blog
        </a>
    @endcan
    @livewire('blog.show-all-blog-livewire')
    
</x-app-layout>