<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div>
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span>{{ $errors->first('email') }}</span>
        @endif
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
        @if ($errors->has('password'))
            <span>{{ $errors->first('password') }}</span>
        @endif
    </div>

    <div>
        <button type="submit">Iniciar sesión</button>
    </div>
</form>
