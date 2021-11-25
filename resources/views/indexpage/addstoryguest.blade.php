<div>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h4>Warning!!!!</h4>
        <h6>peraturan saat menulis cerita anda</h6>
        <ol>
            <li>jangan menyebutkan identitas diri anda <strong> bila anda tidak ingin di ketahui</strong></li>
            <li>ceritakan semua yang ingin anda ceritakan</li>
            <li>di mohon menceritakan semuanya dengan jujur kita di lingkungan <strong>Tellme</strong> akan mensuport
                semua tanpa lansung menghakimi
            </li>
            <li>silakan berkonsultasi bila anda merasa di perlukan dan membutuhkan bantuan</li>
        </ol>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <form action="{{ route('storestoryguest') }}" method="POST">
        @csrf
        <select class="form-select" wire:model='choice' name="choice">
            <option value="text">Text</option>
            <option value="voice">Voice</option>
        </select>
        @if ($choice == 'text')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">tellme</h5>
                    <input id="story" type="hidden" name="story" required>
                    <trix-editor input="story"></trix-editor>
                </div>
            </div>
        @else
            {{ 'asu' }}
        @endif

        @auth
            <a href="{{ route('registers') }}" class="btn btn-secondary mt-2">buat akun</a>
        @endauth
        <button type="submit" class="btn btn-primary mt-2">add story</button>
    </form>
</div>
