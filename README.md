# ToDo App

## Uruchomienie aplikacji

1. **Sklonuj repozytorium:**
    ```sh
    git clone https://github.com/KubaMackowski/ToDoApp.git
    cd ToDoApp
    ```
2. **Skonfiguruj zmienne środowiskowe:**
    ```sh
    cp .env.example .env 
    ```
    Następnie edytuj plik `.env` i zamień poniższe zmienne:
    ```env
    MAIL_MAILER
    MAIL_HOST
    MAIL_PORT
    MAIL_USERNAME
    MAIL_PASSWORD
    MAIL_ENCRYPTION
    MAIL_FROM_ADDRESS
    MAIL_FROM_NAME
   ```
3. **Uruchom kontener Docker:**
    ```sh
    docker-compose up -d --build
    ```
4. **Zainstaluj zależności:**
    ```sh
    docker exec todo_app composer install
    ```
5. **Uruchom migracje:**
    ```sh
    docker exec todo_app php artisan migrate
    ```

6. **Uruchom scheduler i queue:**
   W osobnym terminalu uruchom:
    ```sh
    docker exec -d todo_app php artisan schedule:work
    ```
   oraz
    ```sh
    docker exec -d todo_app php artisan queue:work
    ```
7. **Uruchom aplikację:**
   Aplikacja powinna działać pod adresem `http://localhost:8000`. Możesz to sprawdzić, otwierając przeglądarkę i wpisując ten adres.
