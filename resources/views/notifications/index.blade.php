<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Notifications - DevConnect</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>

    <div class="d-flex align-items-center gap-2">
      
      @if(auth()->check() && strtolower(auth()->user()->role) === 'employer')
        <a href="{{ route('employer.applications') }}" class="btn btn-outline-light">Applications</a>
      @endif

      <form action="{{ route('notifications.read_all') }}" method="POST">
        @csrf
        <button class="btn btn-outline-light">Mark all read</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
  <h3 class="mb-3">Your Notifications</h3>

  @forelse ($notifications as $n)
    <div class="card mb-2 {{ is_null($n->read_at) ? 'border-primary' : '' }}">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <strong>{{ $n->data['message'] ?? 'New notification' }}</strong>
          <div class="text-muted small">{{ $n->created_at->diffForHumans() }}</div>
        </div>

        <div class="d-flex gap-2">
          @if (is_null($n->read_at))
            <form action="{{ route('notifications.read', $n->id) }}" method="POST">
              @csrf
              <button class="btn btn-sm btn-outline-primary">Mark as read</button>
            </form>
          @endif

         
          <a href="{{ $n->data['url'] ?? route('notifications.index') }}" class="btn btn-sm btn-primary">
            Open
          </a>
        </div>
      </div>
    </div>
  @empty
    <div class="alert alert-info">No notifications yet.</div>
  @endforelse>

 
  @if(method_exists($notifications, 'links'))
    <div class="mt-3">
      {{ $notifications->links() }}
    </div>
  @endif
</div>

</body>
</html>
