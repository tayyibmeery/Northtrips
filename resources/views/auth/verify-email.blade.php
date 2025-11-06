<x-guest-layout>
    <p class="login-box-msg">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Resend Verification Email</button>
            </form>
        </div>
        <div class="col-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-secondary">Log Out</button>
            </form>
        </div>
    </div>
</x-guest-layout>
