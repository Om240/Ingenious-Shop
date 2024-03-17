<?php
// login.php
$port='3306';
$host = 'localhost';
$db   = 'smart_shopping';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=localhost;dbname=smart_shopping;charset=utf8mb4";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);

$loginErr = ""; // Initialize $loginErr variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();

    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        if (isset($_POST['main_page'])) {
            header('Location: 2final.php');
            exit();
        } elseif (isset($_POST['product_list'])) {
          header('Location: product_list.php');
          exit();
      }elseif (isset($_POST['customer_page'])) {
            header('Location: 3final.php');
            exit();
        }
    } else {
        $loginErr = 'Invalid username or password'; // Assign error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: url('design.png') no-repeat;
      backdrop-filter: blur(3.5px);
      background-size: cover;
      background-position: center;
    }

    .wrapper {
      width: 420px;
      background: transparent;
      border: 2px solid #514F52;
      backdrop-filter: blur(15px);
      color: #857E88;
      border-radius: 12px;
      padding: 30px 40px;
    }

    .wrapper h1 {
      font-size: 36px;
      text-align: center;
    }

    .wrapper .input-box {
      position: relative;
      width: 100%;
      height: 50px;
      margin: 30px 0;
    }

    .input-box input {
      width: 100%;
      height: 100%;
      background: transparent;
      border: none;
      outline: none;
      border: 2px solid #857E88;
      border-radius: 40px;
      font-size: 16px;
      color: #857E88;
      padding: 20px 45px 20px 20px;
    }

    .input-box input::placeholder {
      color: #857E88;
    }

    .input-box i {
      position: absolute;
      right: 20px;
      top: 30%;
      transform: translate(-50%);
      font-size: 20px;
    }

    .wrapper .btn {
      width: 100%;
      height: 45px;
      background: transparent;
      border: none;
      outline: none;
      border-radius: 40px;
      box-shadow: 0 0 10px #857E88;
      cursor: pointer;
      font-size: 16px;
      color: #514F52;
      font-weight: 600;
      margin-top: 5px;
    }

    .wrapper .register-link {
      font-size: 14.5px;
      text-align: center;
      margin: 20px 0 15px;
    }

    .register-link p a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
    }

    .register-link p a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h1>Login</h1>
      <!-- Error message section -->
      <div class="error-message"><?php echo $loginErr; ?></div>
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <!-- Two buttons for navigation -->
      <button type="submit" name="main_page" class="btn">Main Page</button>
      <button type="submit" name="product_list" class="btn">Product List</button>
      <button type="submit" name="customer_page" class="btn">Customer Page</button>
      
    </form>
  </div>
</body>
</html>
