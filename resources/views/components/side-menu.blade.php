<!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
<div class="position-sticky my-4" style="top: 2rem;">
    <a href="/" class="mb-3" style="text-decoration:none;color:black;">
        <div class="mb-4 rounded border-bottom" @if (Request::is('/'))
            style="color: #0aa2c0;"
        @elseif(Request::is('story*'))
            style="color: #0aa2c0;"
            @endif >
            <h4><i class="bi bi-house-door ms-3 me-2"></i>Home</h4>
        </div>
    </a>
    <a href="/blog" style="text-decoration:none;color:black;">
        <div class="mb-4 rounded border-bottom" @if (Request::is('blog*'))style="color: #0aa2c0;" @endif>
            <h4><i class="ri-stack-fill  ms-3 me-2"></i> Blog</h4>
        </div>
    </a>
    <a href="/save" style="text-decoration:none;color:black;">
        <div class="mb-4 rounded border-bottom" @if (Request::is('save'))style="color: #0aa2c0;" @endif>
            <h4><i class="ri-save-3-line  ms-3 me-2"></i> Save</h4>
        </div>
    </a>
    <a href="/consultation" style="text-decoration:none;color:black;">
        <div class="mb-4 rounded border-bottom" @if (Request::is('consultation'))style="color: #0aa2c0;" @endif>
            <h4><i class="ri-message-line  ms-3 me-2"></i> Consultation</h4>
        </div>
    </a>
    <a href="/profile" style="text-decoration:none;color:black;">
        <div class="mb-4 rounded border-bottom" @if (Request::is('profile'))style="color: #0aa2c0;" @endif>
            <h4><i class="ri-profile-fill  ms-3 me-2"></i> My Story</h4>
        </div>
    </a>
    <a href="/settingprofile" style="text-decoration:none;color:black;">
        <div class="mb-4 rounded border-bottom" @if (Request::is('settingprofile'))style="color: #0aa2c0;" @endif>
            <h4><i class="ri-user-settings-line  ms-3 me-2"></i> Setting</h4>
        </div>
    </a>
    <a href="/suggestions" style="text-decoration:none;color:black;">
        <div class="mb-4 rounded border-bottom" @if (Request::is('suggestions'))style="color: #0aa2c0;" @endif>
            <h4><i class="ri-quill-pen-fill  ms-3 me-2"></i> Suggestions</h4>
        </div>
    </a>
    @auth
        @php
            if (Auth::user()->hasPermissionTo('show-story-dashboard')) {
                $url = '/dashboard/story';
            } elseif (Auth::user()->hasPermissionTo('show-blog-dashboard')) {
                $url = '/dashboard/blog';
            } elseif (Auth::user()->hasPermissionTo('show-komunikasi-dashboard')) {
                $url = '/dashboard/blog';
            } else {
                $url = null;
            }
        @endphp
        @if ($url != null)
            <a href="{{ $url }}" style="text-decoration:none;color:black;">
                <div class="mb-4 rounded border-bottom">
                    <h4><i class="ri-dashboard-line  ms-3 me-2"></i> Dashboard</h4>
                </div>
            </a>
        @endif
    @endauth
    <div class="p-4 mb-3 bg-light rounded">
        <h4 class="fst-italic">Support by :</h4>
        Lin.tech

    </div>
</div>
