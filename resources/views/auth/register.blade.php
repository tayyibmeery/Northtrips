<x-guest-layout>
    <p class="login-box-msg">Register a new membership</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="input-group mb-3">
            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Full name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   autocomplete="name">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="input-group mb-3">
            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="username">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password"
                   required
                   autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="input-group mb-3">
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Confirm password"
                   required
                   autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                        I agree to the <a href="#">terms</a>
                    </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </div>
    </form>

    <p class="mb-0 mt-3">
        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </p>
</x-guest-layout>
