<div>
    <div class="alert alert-warning" role="alert">
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
    </div>

    <form action="{{ route('addstories') }}" method="POST">
        @csrf
        <select class="form-select" wire:model='choice' name="choice">
            <option value="text">Text</option>
            <option value="voice">Voice</option>
        </select>
        <div class="card">
            <div class="card-body">
                @if ($choice == 'text')
                    <h5 class="card-title">tellme</h5>
                    <input id="story" type="hidden" name="story">
                    <trix-editor input="story"></trix-editor>
                @else
                    {{ 'asu' }}
                @endif
                <button type="submit" class="btn btn-primary mt-2">add story</button>
            </div>
        </div>
    </form>
    <script>
        document.addEventlistener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>
</div>
