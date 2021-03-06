<div x-data="{}">
    <form class="search-bar w-search" @click.away="$wire.set('query','')" wire:submit.prevent>
        <div class="form-group with-button is-empty">
            <input wire:model="query" class="form-control js-user-search" placeholder="Поиск друзей, людей . . . " type="text">
            {{-- <button>
                <svg class="olymp-magnifying-glass-icon"><use xank:href="http://127.0.0.1:8000/svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
            </button> --}}
        <span class="material-input"></span></div>
        @if ($result->isNotEmpty())
        <div>
            <div class="users-list">
                @forelse ($result as $item)
                <div class="user-rel"  href="#." onclick="location.href = '{!! route('user.show', ['user' => $item ]) !!}';">
                    <img class="user-avatar-thumb" src="{{ $item->avatar }}" alt="author">
                    <span href="#" class="h6 notification-friend">{{ $item->full_name }}</span>
                    <span class="chat-message-item">{{ $item->country }}, {{ $item->city }}</span>
                    @forelse ($item->usersVehicles as $vehicle)
                    <span class="chat-message-item">{{ $vehicle->type }}:{{ $vehicle->brand }}-{{ $vehicle->model }}</span>
                    @empty
                    <span class="chat-message-item">Пешком хожу!!!</span>
                    @endforelse
                    {{-- <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 часа назад</time></span> --}}
                </div>
                @empty
                @endforelse
            </div>
            <a href="#" class="view-all-users-button bg-purple text-center">Подробный поиск</a>
        </div>
        @endif
    </form>
</div>
