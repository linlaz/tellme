{{-- Success is as dangerous as failure. --}}
<div>
    <div class="title text-center my-4">
        <h3>Setting Account</h3>
    </div>
    <div class="card my-3">
        <div class="card-header">
            <label for="email" class="form-label">Email address</label>
        </div>
        <div class="card-body">
            <input type="email" wire:model="email" class="form-control" id="email" aria-describedby="emailHelp">
            @if (session()->has('successupdateemail'))
                <div class="alert alert-info my-3 alert-dismissible fade show" role="alert">
                    {{ session('successupdateemail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @error('email')
                <div class="alert alert-warning my-3 alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        </div>
        <div class="card-footer text-muted d-flex justify-content-end">
            <button wire:click="updateemail" class="btn btn-primary ">
                Save Change Email
            </button>
        </div>
    </div>

    <div class="card my-3">
        <div class="card-header">
            <label for="Username" class="form-label">Username</label>
        </div>
        <div class="card-body">
            <input type="text" wire:model="name" name="username" class="form-control" id="Username"
                aria-describedby="UsernameHelp">
            @if (session()->has('successupdatename'))
                <div class="alert alert-info my-3 alert-dismissible fade show" role="alert">
                    {{ session('successupdatename') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @error('name')
                <div class="alert alert-warning my-3 alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        </div>
        <div class="card-footer text-muted d-flex justify-content-end">
            <button wire:click="updateusername" class="btn btn-primary ">
                Save Change Username
            </button>
        </div>
    </div>

    <div class="card my-3">
        <div class="card-header">
            <label for="password" class="form-label">password</label>
        </div>
        <div class="card-body">
            {{-- <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Your new password" aria-label="Your new password"
                aria-describedby="basic-addon2" id="show_hide_password">
            <span class="btn btn-info" onclick="myFunction()" id="basic-addon2"><i class="ri-eye-line"></i></span>
        </div> --}}
            <div class="input-group">
                <input wire:model="password" type="password" class="form-control" placeholder="Your new password"
                    aria-label="Your new password" aria-describedby="basic-addon2" id="show_hide_password">
                <span class="btn btn-info" onclick="myFunction()" id="basic-addon2"><i
                        class="ri-eye-line"></i></span>
                {{-- <div class="input-group-addon">
                <a href="">
                    <i class="ri-eye-line"></i>
                </a>
            </div> --}}
            </div>
            <div id="Password" class="form-text">If what change your password you can input new password</div>
            @if (session()->has('successupdatepassword'))
                <div class="alert alert-info my-3 alert-dismissible fade show" role="alert">
                    {{ session('successupdatepassword') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @error('password')
                <div class="alert alert-warning my-3 alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        </div>
        <div class="card-footer text-muted d-flex justify-content-end">
            <button  wire:click="updatepassword" class="btn btn-primary " onclick="confirm('Are you sure you want to chage your password ? you logout after chage') || event.stopImmediatePropagation()">
                Save Change Password
            </button>
        </div>
    </div>

    <div class="card my-3">
        <div class="card-body">
            Your IP :
        </div>
    </div>

</div>
@push('script')
    <script>
        function myFunction() {
            var x = document.getElementById("show_hide_password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    {{-- <script>
        $(document).ready(function() {
            $("#show_hide_password span").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("ri-eye-off-line");
                    $('#sho b w_hide_password i').removeClass("ri-eye-line");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("ri-eye-off-line");
                    $('#show_hide_password i').addClass("ri-eye-line");
                }
            });
        });
    </script> --}}
@endpush
