<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Users List</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
      min-height: 100vh;
      padding-top: 40px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .user-card {
      height: 150px;
      border-radius: 15px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.12);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      cursor: pointer;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 1rem 1.25rem;
      background: #fff;
      border: 3px solid transparent;
    }

    /* Colored border based on age */
    .user-card.under15 {
      border-color: #28a745; /* green */
    }
    .user-card.above15 {
      border-color: #0d6efd; /* blue */
    }

    .user-card:hover {
      transform: translateY(-7px);
      box-shadow: 0 14px 28px rgba(0,0,0,0.25);
      background: #fefefe;
    }

    .user-card .card-header {
      font-weight: 700;
      font-size: 1.25rem;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .user-card .card-email {
      font-size: 0.9rem;
      color: #6c757d;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .user-card .badge-age {
      align-self: flex-end;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.4em 0.9em;
      border-radius: 12px;
    }

    .user-card .collapse-content {
      font-size: 0.9rem;
      margin-top: 0.75rem;
      color: #444;
      line-height: 1.3;
    }
  </style>
</head>
<body>

<div class="container">
  <h1 class="mb-5 text-center text-white fw-bold">Users List</h1>

  <!-- Filter & Search Form -->
  <form method="GET" action="{{ route('users.index') }}" class="row g-3 mb-5 justify-content-center">
    <div class="col-md-3">
      <select name="age_filter" class="form-select shadow-sm">
        <option value="">-- Select Age Filter --</option>
        <option value="under15" {{ request('age_filter') == 'under15' ? 'selected' : '' }}>Show users under 15</option>
        <option value="above15" {{ request('age_filter') == 'above15' ? 'selected' : '' }}>Show users above 15</option>
        <option value="all" {{ request('age_filter') == 'all' ? 'selected' : '' }}>All users</option>
      </select>
    </div>
    <div class="col-md-4">
      <input type="text" name="search" value="{{ request('search') }}" class="form-control shadow-sm" placeholder="Search by name" />
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100 shadow-sm">Apply</button>
    </div>
  </form>

  <div class="row g-4">
    @forelse($users as $user)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="user-card {{ $user->age < 15 ? 'under15' : 'above15' }}" 
             data-bs-toggle="collapse" 
             href="#details-{{ $user->id }}" 
             role="button" 
             aria-expanded="false" 
             aria-controls="details-{{ $user->id }}">
          <div class="card-header" title="{{ $user->name }}">{{ $user->name }}</div>
          <div class="card-email"><i class="bi bi-envelope"></i> {{ $user->email }}</div>
          <span class="badge-age badge {{ $user->age < 15 ? 'bg-success' : 'bg-primary' }}">Age: {{ $user->age }}</span>
          
          <div class="collapse collapse-content" id="details-{{ $user->id }}">
            <hr />
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Age:</strong> {{ $user->age }}</p>
            <!-- You can add more user details here -->
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted text-center fs-5">No users found.</p>
    @endforelse
  </div>

  <p class="mt-4 text-center text-white fw-semibold">Total users: {{ $users->count() }}</p>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
