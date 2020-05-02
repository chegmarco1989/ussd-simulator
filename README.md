# USSD Simulator

This is a Laravel CLI simulator for USSD apps that are built for TNM USSD, or any apps built with the framework <https://github.com/saulchelewani/ussd-adapter>

With this, you can run a USSD app in command-line, whether in development or on live environment.

## How to install
```
composer require tnmdev/ussd-simulator
```

## How to use

```bash
php artisan ussd:simulate <url> <phone>
```

This command reaches your application using the `url` passed as the first argument. All the response coming on the app
 depends on the responses of your application. 
  
```bash
php artisan ussd:simulate https://your-domain.com/api/ussd 265888800900
```

You can also test your apps in development
```bash
php artisan ussd:simulate http://ussd-app.test/api/ussd 265888800900
```

Even running on localhost
```bash
php artisan ussd:simulate http://localhost:8000/api/ussd 26588880900
```

