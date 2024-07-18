<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API para el electivo Computación Movil

Esta API está diseñada para integrarse con la aplicación [MiPlata]([https://github.com/aaguirreu/cm-miplata-utem]) , la cual organiza las finanzas personales mediante la recopilación y organización de información de transferencias bancarias obtenidas a través del protocolo IMAP. Los datos se almacenan en una base de datos PostgreSQL para su posterior análisis y gestión.

### Funcionalidades principales

- Scraping de correos: La API utiliza el protocolo IMAP para acceder a las bandejas de entrada de correos electrónicos de los bancos registrados y extraer información relevante sobre las transferencias bancarias.
- Almacenamiento en PostgreSQL: Los datos recuperados se almacenan de manera estructurada en una base de datos PostgreSQL.
  
## Instalación

- Instalar dependencias

```
composer install
```

- Migrar base de datos

```
php artisan migrate
```

- Se recomienda utilizar supervisor para el comando que ejeuta los jobs y procesan los correos bajo el protocolo IMAP.

```
php artisan emails:process
```

- Importa en Postman el siguiente [Schema](https://github.com/aaguirreu/api-compu-movil/blob/main/API%20de%20Transacciones.postman_collection.json) para consumir la API.

### Schema de la base de datos. No considera las tablas de Sacntum y otros paquetes de Laravel.

![miplata](https://github.com/user-attachments/assets/329ddb78-3969-4dd1-b758-8716f804a9d8)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
