 <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
 <div class="position-sticky my-4" style="top: 2rem;">
     <h2 class="text-center"> Trending Story </h2>
     @foreach ($trending as $item)
         <article class="card mb-3">
             <div class="card-body">
                 <p class="blog-post-meta">{{ $item->created_at }}</p>
                 <div class="mb-3 ">
                     {!! Str::limit(html_entity_decode(strip_tags($item->stories)), 100, '...') !!}<a href="/story/{{ $item->slug }}">[read complete]</a>
                 </div>
             </div>
         </article>
     @endforeach
 </div>
