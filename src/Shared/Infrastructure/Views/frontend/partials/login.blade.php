<form id="form-login" action="{{ route('auth.login') }}" method="POST">
    @csrf
    <h1 class="h3 mb-3 fw-normal text-center">Please login in</h1>
    <div class="form-floating mb-2">
        <select class="form-control" id="login_select_type" name="login_select_type"
                placeholder="Login as" onchange="setType('login')" required>
            <option value=""></option>
            <option value="{{ \App\Src\Frontend\Domain\UserType::TEACHER }}">
                {{ ucfirst(\App\Src\Frontend\Domain\UserType::TEACHER) }}
            </option>
            <option value="{{ \App\Src\Frontend\Domain\UserType::STUDENT }}">
                {{ ucfirst(\App\Src\Frontend\Domain\UserType::STUDENT) }}
            </option>
        </select>
        <label for="login_select_type">Login as</label>
    </div>
    <div class="form-floating mb-2">
        <input type="email" class="form-control @error('email', 'login') is-invalid @enderror"
               id="login_email" name="login_email" placeholder="name@example.com" required>
        <label for="email">Email address</label>
        @error('email', 'login')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating mb-2">
        <input type="password" class="form-control @error('password', 'login') is-invalid @enderror"
               id="login_password" name="login_password" placeholder="Password" required>
        <label for="password">Password</label>
        @error('password', 'login')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" id="login_remember" name="login_remember">
        <label class="form-check-label" for="login_remember">
            Remember me
        </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Login in</button>
    <input type="hidden" id="login_type" name="login_type" value="">
</form>

