@extends('layouts.app')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Jost:wght@300;400;500&display=swap');

  .login-wrap {
    min-height: 100vh;
    background: linear-gradient(145deg, #1C3A12 0%, #2D5016 45%, #3D6B27 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    position: relative;
    overflow: hidden;
    font-family: 'Jost', sans-serif;
  }

  .ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(111,168,69,0.1);
    pointer-events: none;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
  }
  .ring-1 { width: 600px; height: 600px; }
  .ring-2 { width: 420px; height: 420px; }
  .ring-3 { width: 250px; height: 250px; }

  .bg-dot {
    position: absolute;
    border-radius: 50%;
    background: rgba(111,168,69,0.07);
    pointer-events: none;
  }
  .dot-1 { width: 200px; height: 200px; top: -50px; right: -30px; }
  .dot-2 { width: 110px; height: 110px; bottom: -20px; left: 3%; }

  .login-card {
    background: rgba(253,250,245,0.97);
    border-radius: 24px;
    border: 1px solid rgba(255,255,255,0.15);
    padding: 2.5rem 2.2rem 2rem;
    width: 100%;
    max-width: 400px;
    position: relative;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
  }

  .login-top-bar {
    position: absolute;
    top: 0; left: 50%;
    transform: translateX(-50%);
    width: 60px; height: 4px;
    border-radius: 0 0 6px 6px;
    background: linear-gradient(90deg, #4A7C2F, #7AAD52);
  }

  .login-logo { text-align: center; margin-bottom: 1.8rem; }
  .login-logo-icon {
    display: inline-flex; align-items: center; justify-content: center;
    width: 54px; height: 54px; border-radius: 50%;
    background: linear-gradient(135deg, #1C3A12, #3D6B27);
    margin-bottom: 0.8rem;
  }
  .login-logo h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem; color: #1C3A12; font-weight: 600;
    margin: 0 0 0.2rem;
  }
  .login-logo p {
    font-size: 0.78rem; color: #6b8a50;
    letter-spacing: 0.06em; text-transform: uppercase; margin: 0;
  }

  .login-divider { display: flex; align-items: center; gap: 10px; margin-bottom: 1.6rem; }
  .login-line { flex: 1; height: 1px; background: rgba(45,80,22,0.12); }

  .l-field { margin-bottom: 1rem; }
  .l-field label {
    display: block; font-size: 0.75rem; font-weight: 500;
    color: #3D6B27; letter-spacing: 0.07em;
    text-transform: uppercase; margin-bottom: 0.4rem;
  }
  .l-input-wrap { position: relative; }
  .l-input-wrap i {
    position: absolute; left: 0.8rem; top: 50%;
    transform: translateY(-50%); color: #7AAD52; font-size: 16px;
    pointer-events: none;
  }
  .l-input-wrap input {
    width: 100%;
    padding: 0.72rem 1rem 0.72rem 2.6rem;
    border: 1.5px solid rgba(74,124,47,0.18);
    border-radius: 12px;
    background: rgba(240,248,234,0.6);
    font-family: 'Jost', sans-serif;
    font-size: 0.95rem; color: #1C3A12;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  }
  .l-input-wrap input:focus {
    border-color: #4A7C2F;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(74,124,47,0.1);
  }
  .l-input-wrap input.is-invalid { border-color: #c0392b; }

  .invalid-feedback { color: #c0392b; font-size: 0.8rem; margin-top: 4px; display: block; }

  .login-error {
    background: rgba(192,57,43,0.08);
    border: 1px solid rgba(192,57,43,0.2);
    border-radius: 10px;
    padding: 0.7rem 1rem;
    color: #c0392b;
    font-size: 0.82rem;
    margin-bottom: 1rem;
    display: flex; align-items: center; gap: 0.5rem;
  }

  .login-btn {
    width: 100%; padding: 0.88rem; margin-top: 1.3rem;
    background: linear-gradient(135deg, #1C3A12, #3D6B27);
    color: #fff; border: none; border-radius: 14px;
    font-family: 'Jost', sans-serif;
    font-size: 1rem; font-weight: 500; letter-spacing: 0.04em;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(28,58,18,0.35);
    display: flex; align-items: center; justify-content: center; gap: 8px;
    transition: opacity 0.2s, transform 0.15s;
  }
  .login-btn:hover { opacity: 0.9; transform: translateY(-1px); }
  .login-btn:active { transform: scale(0.98); }

  .login-footer {
    text-align: center; margin-top: 1.3rem;
    font-size: 0.85rem; color: #6b8a50;
  }
  .login-footer a {
    color: #2D5016; font-weight: 500;
    border-bottom: 1px dashed rgba(45,80,22,0.4);
    text-decoration: none;
  }
  .login-footer a:hover { border-bottom-style: solid; }
</style>

<div class="login-wrap">
  <div class="ring ring-1"></div>
  <div class="ring ring-2"></div>
  <div class="ring ring-3"></div>
  <div class="bg-dot dot-1"></div>
  <div class="bg-dot dot-2"></div>

  <div class="login-card">
    <div class="login-top-bar"></div>

    <div class="login-logo">
      <div class="login-logo-icon">
        <svg width="26" height="26" viewBox="0 0 32 32" fill="none">
          <path d="M16 4C10 4 5 9 5 16c0 5 3 9 11 13 8-4 11-8 11-13 0-7-5-12-11-12Z"
                fill="white" fill-opacity=".9"/>
          <path d="M16 8c0 0-4 6 0 12 4-6 0-12 0-12Z" fill="#3D6B27"/>
          <path d="M16 20v8" stroke="#3D6B27" stroke-width="2" stroke-linecap="round"/>
          <path d="M11 16c0 0 2 2 5 4" stroke="#3D6B27" stroke-width="1.5" stroke-linecap="round"/>
          <path d="M21 14c0 0-2 3-5 6" stroke="#3D6B27" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
      </div>
      <h2>Bienvenido de vuelta</h2>
      <p>Tu jardín te espera</p>
    </div>

    <div class="login-divider">
      <div class="login-line"></div>
      <span style="color:#a0c080;font-size:11px;">✦</span>
      <div class="login-line"></div>
    </div>

    @if($errors->has('email'))
    <div class="login-error">
      <i class="ti ti-alert-circle" style="font-size:16px;flex-shrink:0;"></i>
      {{ $errors->first('email') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login.authenticate') }}">
      @csrf

      <div class="l-field">
        <label>Correo electrónico</label>
        <div class="l-input-wrap">
          <i class="ti ti-mail"></i>
          <input type="email" name="email"
                 value="{{ old('email') }}"
                 placeholder="correo@ejemplo.com"
                 class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                 required autocomplete="email">
        </div>
        @error('email')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="l-field">
        <label>Contraseña</label>
        <div class="l-input-wrap">
          <i class="ti ti-lock"></i>
          <input type="password" name="password"
                 placeholder="••••••••"
                 class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                 required autocomplete="current-password">
        </div>
        @error('password')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="login-btn">
        <i class="ti ti-leaf" style="font-size:16px;"></i>
        Entrar al jardín
      </button>

    </form>

    <p class="login-footer">
      ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
    </p>
  </div>
</div>

@endsection