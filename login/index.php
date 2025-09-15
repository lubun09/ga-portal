<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login - GA Messenger</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    background: linear-gradient(135deg, #8B0000, #555555, #00008B);
    background-size: 400% 400%;
    animation: gradientBG 10s ease infinite;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #fff;
  }

  @keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .login-container {
    backdrop-filter: blur(10px);
    background: rgba(0, 0, 0, 0.4);
    border-radius: 20px;
    padding: 40px;
    max-width: 400px;
    width: 100%;
    text-align: center;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  }
  .login-container h1 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 8px;
  }
  .login-container p.subtitle {
    font-size: 14px;
    color: #ccc;
    margin-bottom: 20px;
  }
  .lock-icon {
    font-size: 40px;
    color: #ccc;
    margin-bottom: 20px;
  }
  .input-wrapper {
    position: relative;
    margin: 8px 0;
  }
  .login-container input[type="text"],
  .login-container input[type="password"] {
    width: calc(100% - 20px);
    padding: 12px 10px;
    border: none;
    border-radius: 8px;
    background: rgba(255,255,255,0.2);
    color: #fff;
    font-size: 14px;
    box-sizing: border-box;
  }
  .login-container input::placeholder {
    color: #ddd;
  }
  .toggle-password {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
    color: #ddd;
    user-select: none;
  }
  .login-container button {
    width: calc(100% - 20px);
    padding: 12px 10px;
    margin-top: 12px;
    background: linear-gradient(90deg, #FF0000, #555555, #00008B);
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: background 0.3s;
    box-sizing: border-box;
  }
  .login-container button:hover {
    background: linear-gradient(90deg, #8B0000, #333333, #000080);
  }
</style>
</head>
<body>
<div class="login-container">
  <h1>KPN CORP</h1>
  <p class="subtitle">GA Portal</p>
  <div class="lock-icon">&#128274;</div>
  <form method="post" action="/ga-messenger/proses_login.php">
    <input type="text" name="username" placeholder="Username" required />
    <div class="input-wrapper">
      <input type="password" id="password" name="password" placeholder="Password" required />
      <span class="toggle-password" onclick="togglePassword()">👁</span>
    </div>
    <button type="submit">Login</button>
  </form>
</div>
<script>
  function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggle = document.querySelector('.toggle-password');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      toggle.textContent = '👁';
    } else {
      passwordInput.type = 'password';
      toggle.textContent = '👁';
    }
  }
</script>
</body>
</html>
