@extends('layouts.app')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Jost:wght@300;400;500&display=swap');

  .landscape-wrap {
    min-height: 100vh;
    background: linear-gradient(160deg, #e8f0e0 0%, #d4e8c2 40%, #c2dba8 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    font-family: 'Jost', sans-serif;
  }
  .ls-card {
    background: rgba(255,255,255,0.82);
    backdrop-filter: blur(8px);
    border-radius: 24px;
    border: 1.5px solid rgba(120,160,80,0.25);
    padding: 2.5rem 2.2rem 2rem;
    width: 100%; max-width: 420px;
    box-shadow: 0 8px 40px rgba(60,100,30,0.10);
    position: relative;
  }
  .ls-top-bar {
    position: absolute; top: 0; left: 50%;
    transform: translateX(-50%);
    width: 70px; height: 5px;
    border-radius: 0 0 8px 8px;
    background: linear-gradient(90deg, #6a9a3a, #a0c060);
  }
  .ls-logo { text-align: center; margin-bottom: 1.6rem; }
  .ls-logo-icon {
    display: inline-flex; align-items: center; justify-content: center;
    width: 52px; height: 52px; border-radius: 50%;
    background: linear-gradient(135deg, #b8dca0, #78b848);
    margin-bottom: 0.7rem;
  }
  .ls-logo h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.55rem; color: #2e5018; font-weight: 600;
  }
  .ls-logo p { font-size: 0.78rem; color: #6b8a50; letter-spacing: 0.05em; text-transform: uppercase; }
  .ls-divider { display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem; }
  .ls-line { flex: 1; height: 1px; background: rgba(100,140,60,0.2); }
  .ls-field { margin-bottom: 1rem; }
  .ls-field label {
    display: block; font-size: 0.78rem; font-weight: 500;
    color: #4a6e28; letter-spacing: 0.06em;
    text-transform: uppercase; margin-bottom: 0.4rem;
  }
  .ls-input-wrap { position: relative; }
  .ls-input-icon {
    position: absolute; left: 0.8rem; top: 50%;
    transform: translateY(-50%); color: #8ab860; font-size: 16px;
  }
  .ls-input-wrap input {
    width: 100%;
    padding: 0.7rem 1rem 0.7rem 2.6rem;
    border: 1.5px solid rgba(100,150,60,0.22);
    border-radius: 12px;
    background: rgba(245,252,238,0.8);
    font-family: 'Jost', sans-serif;
    font-size: 0.95rem; color: #2e4a18;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
  }
  .ls-input-wrap input:focus {
    border-color: #78b848;
    box-shadow: 0 0 0 3px rgba(120,184,72,0.13);
    background: #fff;
  }
  .ls-btn {
    width: 100%; padding: 0.85rem; margin-top: 1.2rem;
    background: linear-gradient(135deg, #5a8c28, #7ab840);
    color: #fff; border: none; border-radius: 14px;
    font-family: 'Jost', sans-serif;
    font-size: 1rem; font-weight: 500; letter-spacing: 0.05em;
    cursor: pointer;
    box-shadow: 0 4px 16px rgba(90,140,40,0.25);
    transition: opacity 0.2s, transform 0.15s;
  }
  .ls-btn:hover { opacity: 0.92; transform: translateY(-1px); }
  .ls-footer { text-align: center; margin-top: 1.2rem; font-size: 0.85rem; color: #6b8a50; }
  .ls-footer a { color: #4a8020; font-weight: 500; }
  .is-invalid { border-color: #d85a30 !important; }
  .invalid-feedback { color: #d85a30; font-size: 0.8rem; margin-top: 4px; }
</style>

<div class="landscape-wrap">
  <div class="ls-card">
    <div class="ls-top-bar"></div>

    <div class="ls-logo">
      <div class="ls-logo-icon">
        <svg width="26" height="26" viewBox="0 0 32 32" fill="none">
          <path d="M16 4C10 4 5 9 5 16c0 5 3 9 11 13 8-4 11-8 11-13 0-7-5-12-11-12Z" fill="white" fill-opacity=".9"/>
          <path d="M16 8c0 0-4 6 0 12 4-6 0-12 0-12Z" fill="#5a9828"/>
          <path d="M16 20v8" stroke="#5a9828" stroke-width="2" stroke-linecap="round"/>
          <path d="M11 16c0 0 2 2 5 4" stroke="#5a9828" stroke-width="1.5" stroke-linecap="round"/>
          <path d="M21 14c0 0-2 3-5 6" stroke="#5a9828" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
      </div>
      <h2>Crea tu cuenta</h2>
      <p>Diseño vivo · Naturaleza en tu espacio</p>
    </div>

    <div class="ls-divider">
      <div class="ls-line"></div>
      <span style="color:#8ab860;font-size:12px;">✦</span>
      <div class="ls-line"></div>
    </div>

    <form method="POST" action="{{ route('register.store') }}">
      @csrf

      <div class="ls-field">
        <label>Nombre completo</label>
        <div class="ls-input-wrap">
          <i class="ti ti-user ls-input-icon"></i>
          <input type="text" name="name" value="{{ old('name') }}"
            placeholder="Tu nombre"
            class="{{ $errors->has('name') ? 'is-invalid' : '' }}" required>
        </div>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="ls-field">
        <label>Correo electrónico</label>
        <div class="ls-input-wrap">
          <i class="ti ti-mail ls-input-icon"></i>
          <input type="email" name="email" value="{{ old('email') }}"
            placeholder="correo@ejemplo.com"
            class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required>
        </div>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="ls-field">
        <label>Contraseña</label>
        <div class="ls-input-wrap">
          <i class="ti ti-lock ls-input-icon"></i>
          <input type="password" name="password" placeholder="••••••••"
            class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required>
        </div>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="ls-field">
        <label>Confirmar contraseña</label>
        <div class="ls-input-wrap">
          <i class="ti ti-lock-check ls-input-icon"></i>
          <input type="password" name="password_confirmation" placeholder="••••••••" required>
        </div>
      </div>

      <button type="submit" class="ls-btn">🌿 Unirme al jardín</button>
    </form>

    <p class="ls-footer">
      ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
    </p>
  </div>
</div>

@endsection