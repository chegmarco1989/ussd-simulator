# USSD Simulator

This is a CLI simulator for TNM USSD Applications

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

