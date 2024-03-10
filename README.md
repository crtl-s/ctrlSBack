# Progressa - Backend

Unutar ovog repsoitorja se nalazi backend dio sustava

## Requiraments

Prije nego što krenemo sa pokretanjem, potrebno je provjeriri imamo li sve alate koji su nam potrebni za rad.
Lista alataa koje MORAMO imati kako bi sve funkcioniralo

- Laragon / XAMPP
- Laravel
- Composer
- PHP

  # Pokretanje porjekta

nakon što smo klonirali projekt potrebno je unijeti sljedeće naredbe.
Ovo će postaviti projekt i pripremiti radno okružje za rad

  ```shell
  npm init
  composer install
  npm install
  ```
**NAPOMENA** jedna od bitnih stvari je nakon inicijalizacije projekta podesiti .env datoteku da se spoji sa našom lokalnom bazom

Nakon što se proces inicijalizacije završio potrebno pripremiti bazu podataka


  ```shell
  php artisan migrate
  ```

Kako bismo pokrenuli lokalni server potrebno je pokrenuti sljedeću naredbu

```shell
  php artisan serve
```
  
