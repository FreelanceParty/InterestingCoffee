<div align="center" id="readme-top">
   <img src="https://seeklogo.com/images/C/coffee-time-logo-187E7F85DE-seeklogo.com.png" width="100" height="100"> 
   <div style="font-size: 32px; font-weight: bold;">Цікава Кава</div>
</div>

## :interrobang: Необхідно мати на ПК:

1. Composer.
2. OpenServer (з PHP 8.1 та MySQL 8.0).
3. PhpStorm або VS Code.
- PHP та Composer мають бути доступні глобально (додані до системного шляху).
- Якщо глобально вони недоступні, то потрібно змінити термінал IDE на Git Bash, або виконувати команди через термінал ПК.

## :wrench: Встановлення та запуск:

1. Склонувати проект: `git clone -o github https://github.com/FreelanceParty/InterestingCoffee`.
2. Скопіювати `.env.example` та назвати `.env`.
3. Запустити `composer update`.
4. Запустити `php artisan key:generate`, ключ має з'явитись в файлі `.env`.
5. Запустити `php artisan migrate` та `php artisan db:seed` для заповнення БД тестовими даними.

## :wrench: Налаштування OpenServer:
1. Server:
   1. Setting Path variable use: `Own Path + userdata... + Win Path`
2. Domains: 
   1. Domain management: `Manual + Autosearch`
   2. Додати `Domain name`, за адресою якого відкривається сайт в браузері.
   3. Задати `Domain folder` як шлях до папки `public` у проекті.