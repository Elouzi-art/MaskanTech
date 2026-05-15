@auth
    @if(auth()->user()->role === 'admin')
        @include('pages.admin')
    @elseif(auth()->user()->role === 'owner')
        @include('dashboard.owner')
    @elseif(auth()->user()->role === 'student')
        @include('dashboard.student')
    @else
        @include('dashboard.tenant')
    @endif
@else
    <script>window.location.href = '/login';</script>
@endauth
