<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(\Auth::user()->name . "'s dashboard" )}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-columns">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">
                            Contacts
                        </h5>
                        <p class="card-text">
                            My: {{ \App\Models\Contacts::query()->where('user_id', \Auth::id())->count() }}<br>
                            Created in last 24h: {{ \App\Models\Contacts::query()->where("created_at", ">=", \Carbon\Carbon::now()->subDay())->where('user_id', \Auth::id())->count() }}<br>
                            In percentage of total: {{ round(\App\Models\Contacts::query()->where('user_id', \Auth::id())->count() / \App\Models\Contacts::query()->count() * 100, 2)}}%
                        </p>
                    </div>
                </div>
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">
                            Tickets
                        </h5>
                        <p class="card-text">
                            My: {{ \App\Models\Ticket::query()->where('user_id', \Auth::id())->count() }}; Opened: {{ \App\Models\Ticket::query()->where('user_id', \Auth::id())->whereNull('is_done')->count() }};  Closed: {{ \App\Models\Ticket::query()->where('user_id', \Auth::id())->whereNotNull('is_done')->count() }}<br>
                            Created in last 24h: {{ \App\Models\Ticket::query()->where("created_at", ">=", \Carbon\Carbon::now()->subDay())->where('user_id', \Auth::id())->count() }}<br>
                            In percentage of total: {{ round(\App\Models\Ticket::query()->where('user_id', \Auth::id())->count() / \App\Models\Ticket::query()->count() * 100, 2)}}%
                        </p>
                    </div>
                </div>
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">
                            Global
                        </h5>
                        <p class="card-text">
                            Contacts: {{ \App\Models\Contacts::query()->count() }}<br>
                            Users: {{ \App\Models\User::query()->count() }}<br>
                            Tickets: {{ \App\Models\Ticket::query()->count() }}; Opened: {{ \App\Models\Ticket::query()->whereNull('is_done')->count() }}; Closed: {{ \App\Models\Ticket::query()->whereNotNull('is_done')->count() }}<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
