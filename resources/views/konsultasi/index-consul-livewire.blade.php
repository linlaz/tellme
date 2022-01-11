{{-- The best athlete wants his opponent at his best. --}}
<div>
    <div class="row justify-content-center ">
        <div class="@if (isset($sender))col-md-4 d-md-none d-lg-block d-sm-none d-md-block d-none d-sm-block @else col @endif">
            <div class="card">
                <div class="card-header">
                   Listener
                </div>
                <div class="card-body  p-0 list-group" style="height:500px; overflow-y: scroll;">
                    @foreach ($users as $user)
                        @if ($user->id !== auth()->id())
                            @php
                                $not_seen =
                                    App\Models\Message::where('user_id', $user->id)
                                        ->where('receiver_id', auth()->id())
                                        ->where('is_seen', false)
                                        ->get() ?? null;
                            @endphp
                            <a wire:click="getUser({{ $user->id }})"
                                class="btn list-group-item list-group-item-action @if (isset($sender)) @if ($sender->id == $user->id) list-group-item-primary @else list-group-item-light @endif @endif  d-flex justify-content-between align-items-start">

                                <div class="ms-2 me-auto">
                                    {{-- <div class="fw-bold">
                                        {{ $user->getRoleNames() }}
                                    </div> --}}
                                    {{ $user->name }}
                                    @if ($user->is_online == true)
                                        <i class="ri-record-circle-line"></i>
                                    @endif
                                </div>
                                @if (filled($not_seen))
                                    <span class="badge bg-primary rounded-pill">{{ $not_seen->count() }}</span>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="  @if (is_null($sender)) col-md-8 d-md-none d-lg-block d-sm-none d-md-block d-none d-sm-block @else col @endif ">
            <div class="card">
                <div class="card-header">
                    @if (isset($sender))
                        <button class="btn" wire:click="resetsender">
                            <i class="ri-arrow-left-line"></i>
                        </button>
                        {{ $sender->name }}
                    @endif
                </div>
                <div class="card-body p-2" style="height:500px; overflow-y: scroll;" wire:poll="mountdata">
                    @if (filled($allmessages))
                        @foreach ($allmessages as $mgs)
                            <div class="single-message @if ($mgs->user_id == auth()->id()) sent @else received @endif">
                                {{-- <p class="font-weight-bolder my-0">{{ $mgs->user->name }}</p> --}}
                                {{ $mgs->message }}
                                <br><small class="text-muted w-100">Sent <em>{{ $mgs->created_at }}</em></small>
                            </div>

                        @endforeach
                    @endif
                    @if (is_null($sender))
                        <div class="d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="96" height="96">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M10 14.676v-.062c0-2.508 2.016-4.618 4.753-5.233C14.389 7.079 11.959 5.2 8.9 5.2 5.58 5.2 3 7.413 3 9.98c0 .969.36 1.9 1.04 2.698.032.038.083.094.152.165a3.568 3.568 0 0 1 1.002 2.238 3.612 3.612 0 0 1 2.363-.442c.166.026.302.046.405.06A7.254 7.254 0 0 0 10 14.675zm.457 1.951a9.209 9.209 0 0 1-2.753.055 19.056 19.056 0 0 1-.454-.067 1.612 1.612 0 0 0-1.08.212l-1.904 1.148a.806.806 0 0 1-.49.117.791.791 0 0 1-.729-.851l.15-1.781a1.565 1.565 0 0 0-.439-1.223 5.537 5.537 0 0 1-.241-.262C1.563 12.855 1 11.473 1 9.979 1 6.235 4.537 3.2 8.9 3.2c4.06 0 7.403 2.627 7.85 6.008 3.372.153 6.05 2.515 6.05 5.406 0 1.193-.456 2.296-1.229 3.19-.051.06-.116.13-.195.21a1.24 1.24 0 0 0-.356.976l.121 1.423a.635.635 0 0 1-.59.68.66.66 0 0 1-.397-.094l-1.543-.917a1.322 1.322 0 0 0-.874-.169c-.147.023-.27.04-.368.053-.316.04-.64.062-.969.062-2.694 0-4.998-1.408-5.943-3.401zm6.977 1.31a3.325 3.325 0 0 1 1.676.174 3.25 3.25 0 0 1 .841-1.502c.05-.05.087-.09.106-.112.489-.565.743-1.213.743-1.883 0-1.804-1.903-3.414-4.4-3.414-2.497 0-4.4 1.61-4.4 3.414s1.903 3.414 4.4 3.414c.241 0 .48-.016.714-.046.08-.01.188-.025.32-.046z"
                                    fill="rgba(34,103,135,0.33)" />
                            </svg>
                        </div>
                        <h3 class="text-center my-auto"> Select One User </h3>
                    @endif
                </div>
                @if (isset($sender))
                    <div class="card-footer">
                        <form wire:submit.prevent="SendMessage">
                            <div class="row">
                                <div class="col-md-8">
                                    <input wire:model="message"
                                        class="form-control mb-3 input shadow-none w-100 d-inline-block"
                                        placeholder="Type a message" required>
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary d-inline-block w-100"><i
                                            class="far fa-paper-plane"></i> Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
