<form method="post" action="{{ route('changeLanguage') }}">
    @csrf
    <select name="language" onchange="this.form.submit()">
        @foreach (config('app.supported_locales') as $locale)
            <option value="{{ $locale }}" {{ app()->getLocale() === $locale ? 'selected' : '' }}>
                {{ strtoupper($locale) }}
            </option>
        @endforeach
    </select>
</form>


{{-- <form class="form-inline" method="post" action="{{ route('changeLanguage') }}">
    @csrf
    <div class="form-group">
        <label for="language" class="mr-2">Select Language:</label>
        <select class="form-control" name="language" id="language" onchange="this.form.submit()">
            @foreach (config('app.supported_locales') as $locale)
                <option value="{{ $locale }}" {{ app()->getLocale() === $locale ? 'selected' : '' }}>
                    {{ strtoupper($locale) }}
                </option>
            @endforeach
        </select>
    </div>
</form> --}}
