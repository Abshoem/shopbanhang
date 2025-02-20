<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 11 Custom User Register Page - itsolutionstuff.com</title>
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
    .text-center a {
      font-weight: 500;
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
              <h2>Create Account</h2>
            </div>
            <form method="POST" action="{{ route('register.post') }}">
              @csrf

              @session('error')
              <div class="alert alert-danger" role="alert">
                {{ $value }}
              </div>
              @endsession

              <div class="mb-3 form-floating">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Your Name" required>
                <label for="name">{{ __('Name') }}</label>
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="mb-3 form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" required>
                <label for="email">{{ __('Email Address') }}</label>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="mb-3 form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="mb-3 form-floating">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="d-grid mb-3">
                <button class="btn btn-primary btn-lg" type="submit">{{ __('Register') }}</button>
              </div>

              <div class="text-center">
                <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="link-primary text-decoration-none">Sign in</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
