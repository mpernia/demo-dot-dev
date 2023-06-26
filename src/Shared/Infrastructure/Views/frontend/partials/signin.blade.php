<form id="form-signin" action="{{ route('auth.signin') }}" method="POST">
    @csrf
    <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
    <div class="form-floating mb-2">
        <select class="form-control" id="signin_select_type" name="signin_select_type"
                placeholder="Login as" onchange="setType('signin')" required>
            <option value=""></option>
            <option value="{{ \App\Src\Frontend\Domain\UserType::TEACHER }}">
                {{ ucfirst(\App\Src\Frontend\Domain\UserType::TEACHER) }}
            </option>
            <option value="{{ \App\Src\Frontend\Domain\UserType::STUDENT }}">
                {{ ucfirst(\App\Src\Frontend\Domain\UserType::STUDENT) }}
            </option>
        </select>
        <label for="signin_select_type">Login as</label>
    </div>
    <div class="form-floating mb-2">
        <input type="text" class="form-control" id="signin_name" name="signin_name" placeholder="Name">
        <label for="signin_name">Name</label>
    </div>
    <div class="form-floating mb-2">
        <input type="email" class="form-control @error('email', 'signin') is-invalid @enderror"
               id="signin_email" name="signin_email" placeholder="name@example.com" required>
        <label for="email">Email address</label>
        @error('email', 'signin')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating mb-2">
        <input type="password" class="form-control @error('password', 'signin') is-invalid @enderror"
               id="signin_password" name="signin_password" placeholder="Password" required>
        <label for="password">Password</label>
        @error('password', 'signin')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    <input type="hidden" id="signin_type" name="signin_type" value="">
</form>