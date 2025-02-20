<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 11 Custom User Login Page - itsolutionstuff.com</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #5563DE;
      --primary-dark: #4452c4;
      --light-bg: #ffffff;
      --gradient-start: #74ABE2;
      --gradient-end: #5563DE;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .card-body {
      padding: 2rem 3rem;
      background: var(--light-bg);
      border-radius: 20px;
    }
    .custom-header {
      text-align: center;
      margin-bottom: 1.5rem;
      position: relative;
    }
    .custom-header h2 {
      font-size: 1.75rem;
      font-weight: 600;
      margin: 0;
      color: var(--primary-color);
    }
    .custom-header::after {
      content: "";
      width: 50px;
      height: 4px;
      background: var(--primary-color);
      display: block;
      margin: 0.5rem auto 0;
      border-radius: 2px;
    }
    .form-floating > label {
      transition: all 0.2s ease-in-out;
      color: #888;
    }
    .form-floating .form-control:focus + label,
    .form-floating .form-control:not(:placeholder-shown) + label {
      font-size: 0.85rem;
      transform: translateY(-0.8rem);
      color: var(--primary-color);
    }
    .form-control {
      border-radius: 10px;
      height: 3.5rem;
      box-shadow: none;
      border: 1px solid #ced4da;
      transition: border-color 0.2s;
    }
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(85, 99, 222, 0.25);
    }
    .btn-primary {
      background: var(--primary-color);
      border: none;
      border-radius: 10px;
      height: 3.5rem;
      transition: background 0.3s;
    }
    .btn-primary:hover {
      background: var(--primary-dark);
    }
    .social-buttons {
      margin-top: 1.5rem;
      display: flex;
      justify-content: space-around;
    }
    .social-buttons a {
      width: 45px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      border: 1px solid #ddd;
      transition: all 0.3s;
      color: #444;
      text-decoration: none;
    }
    .social-buttons a:hover {
      border-color: var(--primary-color);
      color: var(--primary-color);
    }
    .form-check-input {
      width: 1.25em;
      height: 1.25em;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-5">
        <div class="card">
          <div class="card-body">
            <div class="custom-header">
              <h2>Sign In</h2>
            </div>
            <form method="POST" action="{{ route('login.post') }}">
              @csrf

              @session('error')
              <div class="alert alert-danger" role="alert">
                {{ $value }}
              </div>
              @endsession

              <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" required>
                <label for="email">{{ __('Email Address') }}</label>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" name="rememberMe" id="rememberMe">
                  <label class="form-check-label" for="rememberMe">
                    Keep me logged in
                  </label>
                </div>
                <a href="#!" class="link-primary text-decoration-none">{{ __('forgot password?') }}</a>
              </div>
              <div class="d-grid mb-3">
                <button class="btn btn-primary btn-lg" type="submit">{{ __('Login') }}</button>
              </div>
              <div class="text-center">
                <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="link-primary text-decoration-none">Sign up</a></p>
              </div>
            </form>
            <!-- Phần các nút đăng nhập xã hội (trang trí, không ảnh hưởng đến chức năng) -->
            <div class="social-buttons">
              <a href="#!" title="Login with Facebook">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                  <path d="M8.051 8.042H6.457V11H4.962V8.042H3.843V6.741h1.119V5.757c0-1.086.621-2.687 2.687-2.687h1.845v1.449H7.45c-.166 0-.399.083-.399.43v1.109h1.659l-.223 1.301z"/>
                </svg>
              </a>
              <a href="#!" title="Login with Twitter">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                  <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.341 0-.141 0-.283-.01-.424A6.68 6.68 0 0 0 16 3.542a6.556 6.556 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.084.797A3.286 3.286 0 0 0 7.88 6.03a9.325 9.325 0 0 1-6.767-3.431 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.041a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115c-.212 0-.418-.021-.616-.061a3.289 3.289 0 0 0 3.067 2.279A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                </svg>
              </a>
              <a href="#!" title="Login with Google">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                  <path d="M8.159 8.62v2.518h4.377c-.18 1.136-1.31 3.32-4.377 3.32-2.63 0-4.769-2.173-4.769-4.845s2.14-4.845 4.77-4.845c1.503 0 2.513.64 3.092 1.188l2.112-2.04C11.824 3.13 10.177 2.5 8.159 2.5 4.599 2.5 2 5.22 2 8.465S4.6 14.43 8.16 14.43c3.54 0 5.89-2.48 5.89-5.96 0-.4-.045-.703-.09-1.012H8.16z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
