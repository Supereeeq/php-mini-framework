<?php

ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    class User {
        private static int $counter = 0;
        public function __construct(
            private string $login,
            string $haslo
        )
        {
            $this->haslo = password_hash($haslo, PASSWORD_DEFAULT);
            $this->id = self::$counter;
            self::$counter++;
        }
        public function getId() :int
        {
            return $this->id;
        }
        public function getLogin() :string
        {
            return $this->login;
        }
        public function getHaslo() :string
        {
            return $this->haslo;
        }
    }

    $uzytkownicy = array(
        new User("adam", "123"),
        new User("jakub", "987")
    );

    class InvalidCredentialsException extends \Error{}

    class LoginService {
        public static function attempt(string $login, string $password, array $uzytkownicy) :User
        {
            foreach($uzytkownicy as $user)
            {
                if($user->getLogin() == $login)
                {
                    if(password_verify($password,$user->getHaslo()))
                    {
                        return $user;
                    }
                    throw new InvalidCredentialsException("Niepoprawny login lub haslo");
                }
            }
            throw new InvalidCredentialsException("Niepoprawny login lub haslo");
        }
    }

    
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

try {
    if(LoginService::attempt($login, $haslo, $uzytkownicy)) echo "zalogowano";
}
catch (InvalidCredentialsException $e){
    echo "zle";
}
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Czekolandia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Witaj w <a href="index.php">Czekolandii</a></h1>
    </header>
    <main>
        <form method="POST"  class="form-logowania">
            <h3>Zaloguj się</h3>
            <input type="text" placeholder="Podaj login" name="login"/>
            <input type="password" placeholder="Podaj hasło" name="haslo"/>
            <button type="submit">Zapisz</button>
        </form>
    </main>
    <footer>

    </footer>
    
</body>
</html>