<x-layoutAuth>
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{ route('register.process') }}" method="post">
        @csrf

        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full name" value="{{ old('name') }}">
          <div class="input-group-append">...</div>
        </div>
        @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
          <div class="input-group-append">...</div>
        </div>
        @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
          <div class="input-group-append">...</div>
        </div>
        @error('password')<div class="alert alert-danger">{{ $message }}</div>@enderror

        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
          <div class="input-group-append">...</div>
        </div>

        <div class="row">
          <div class="col-8">
            ...
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>

      {{-- ... bagian social auth ... --}}

      <a href="{{ route('AuthLogin') }}" class="text-center">I already have a membership</a>
    </div>
  </div>
</div>
</x-layoutAuth>
