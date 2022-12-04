<x-layout.pure>
    <form action="" method="post" class="d-flex flex-column justify-content-center align-items-center vh-100 mx-auto"
          style="width: 500px;">
        @csrf
        <div class="mb-3 w-100">
            <label for="email" class="form-label">{{ __('custom.headings.email') }}</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        @if($errors->has('email'))
            @foreach($errors->get('email') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endisset
        <div class="mb-3 w-100">
            <label for="password" class="form-label">{{ __('custom.headings.password') }}</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        @if($errors->has('password'))
            @foreach($errors->get('password') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endisset
        <div class="buttons-wrapper w-100 d-flex justify-content-between">
            <a href="{{ route('home') }}">{{ __('custom.back_page', ['type' => 'home']) }}</a>
            <button type="submit" class="btn btn-primary">{{ __('custom.action.submit') }}</button>
        </div>
        <div class="oauth-buttons">
            <a href="{{ $urlGithub }}">
                <button type="button"
                        class="btn btn-outline-dark">
                    {{ __('custom.sign_in_with_type', ['type' => 'github']) }}
                    <i class="bi bi-github"></i>
                </button>
            </a>
            <a href="{{ $urlTwitch }}">
                <button type="button"
                        class="btn btn-outline-dark">
                    {{ __('custom.sign_in_with_type', ['type' => 'twitch']) }}
                    <i class="bi bi-twitch"></i>
                </button>
            </a>
        </div>
    </form>
</x-layout.pure>
