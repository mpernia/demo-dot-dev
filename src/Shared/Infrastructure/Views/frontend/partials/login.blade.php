<form id="form-login" action="{{ route('auth.login') }}" method="POST">
    @csrf
    <h1 class="h3 mb-3 fw-normal text-center">Please login in</h1>
    <div class="form-floating mb-2">
        <select class="form-control" id="select_type" name="select_type"
                placeholder="Login as" required>
            <option value=""></option>
            <option value="{{ \App\Src\Frontend\Domain\UserType::TEACHER }}">
                {{ ucfirst(\App\Src\Frontend\Domain\UserType::TEACHER) }}
            </option>
            <option value="{{ \App\Src\Frontend\Domain\UserType::STUDENT }}">
                {{ ucfirst(\App\Src\Frontend\Domain\UserType::STUDENT) }}
            </option>
        </select>
        <label for="select_type">Login as</label>
    </div>
    <div class="form-floating mb-2">
        <input type="email" class="form-control @error('email', 'login') is-invalid @enderror"
               id="email" name="email" placeholder="name@example.com" required>
        <label for="email">Email address</label>
        @error('email', 'login')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating mb-2">
        <input type="password" class="form-control @error('password', 'login') is-invalid @enderror"
               id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
        @error('password', 'login')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" id="remember" name="remember">
        <label class="form-check-label" for="remember">
            Remember me
        </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Login in</button>
    <!-- <input type="hidden" id="type" name="type" value=""> -->
</form>

