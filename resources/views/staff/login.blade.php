<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Admin</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #7B61FF;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .circle {
      position: absolute;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.08);
    }

    .circle.one {
      width: 300px; height: 300px;
      top: -60px; left: -60px;
    }

    .circle.two {
      width: 400px; height: 400px;
      bottom: -120px; right: -100px;
    }

    .circle.three {
      width: 150px; height: 150px;
      bottom: 50px; left: 60px;
    }

    .circle.four {
      width: 100px; height: 100px;
      top: 80px; right: 80px;
    }


    .card {
      background-color: white;
      padding: 40px;
      border-radius: 20px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      z-index: 10;
    }

    .card h2 {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 8px;
    }

    .card p {
      text-align: center;
      font-size: 14px;
      color: #555;
      margin-bottom: 30px;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group input {
      width: 100%;
      padding: 12px 40px 12px 40px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }

    .input-group .icon {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: #999;
      font-size: 16px;
    }

    .input-group .eye {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      color: #999;
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 14px;
      margin-bottom: 30px;
    }

    .options label {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #333;
    }

    .options a {
      color: #6b5cff;
      text-decoration: none;
    }

    .options a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      background-color: #2D2E49;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #1e1f33;
    }
  </style>
</head>
<body>

  <!-- Background Circles -->
  <div class="circle one"></div>
  <div class="circle two"></div>
  <div class="circle three"></div>
  <div class="circle four"></div>
  <div class="circle five stroke"></div>
  <div class="circle six stroke"></div>

  <!-- Login Card -->
  <div class="card">
    <h2>Hallo Admin !</h2>
    <p>Masukkan Informasi Akun</p>

    <form action="{{ route('staff.login.process') }}" method="POST">
  @csrf
  <div class="input-group">
    <span class="icon">&#128100;</span>
    <input 
      type="email" 
      name="email" 
      placeholder="Masukkan Email" 
      required 
      value="{{ old('email') }}" />
  </div>

  <div class="input-group">
    <span class="icon">&#128274;</span>
    <span class="eye">&#128065;</span>
    <input 
      type="password" 
      name="password" 
      placeholder="Masukkan Password" 
      required />
  </div>

  <div class="options">
    <label>
      <input type="checkbox" name="remember" />
      Ingat Saya
    </label>
    <a href="#">Lupa Password?</a>
  </div>

  <button type="submit">Login</button>
</form>

  </div>

</body>
</html>
