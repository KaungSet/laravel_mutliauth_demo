@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(auth()->guard('admin')->check())
    <h1>Currently Login As Admin</h1>
    <h1>Admin Name is : {{auth()->guard('admin')->user()->name}}</h1>
@elseif(auth()->guard('web')->check())
    <h1>Currently Login As User</h1>
    <h1>User Name is : {{auth()->guard('web')->user()->name}}</h1>
@else
    <h1>No Authenticated User</h1>
@endif

<div>
    <a href="{{route('admin-login-form')}}"><Button>Admin Login</Button></a>
    <a href="{{route('admin-logout')}}"><Button>Admin Logout</Button></a>
</div>
<div>
    <a href="{{route('login')}}"><Button>User Login</Button></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        <button type="submit">User Logout</button>
    </form>
</div>
<div>
    <a href="{{route('admin-index')}}"><button>Admin Page</button></a>
    <a href="{{route('user-index')}}"><button>User Page</button></a>
</div>