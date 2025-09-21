# Psico Desarrollo

_PsicoDesarrollo es un sistema web diseñado para la gestión integral de evaluaciones psicológicas en la primera infancia (0 a 6 años). Permite a especialistas registrar historias clínicas, agendar citas, aplicar y evaluar pruebas psicológicas estandarizadas y no estandarizadas (como CUMANIN y Koppitz), y generar informes detallados. Desarrollado con Laravel 8, MySQL y tecnologías web modernas, el sistema busca optimizar el seguimiento del desarrollo infantil mediante herramientas digitales accesibles y estructuradas._

## Comenzando 🚀

1. Clonar proyecto:

```bash
git clone https://github.com/ivanamar12/psico-desarrollo.git
```

### Pre-requisitos 📋

- PHP v^8.2
- Node.js v^18 (Recomendado)
- MySQL o MariaDB

### Instalación 🔧

1. Instalar dependencias:

```bash
composer install
```

```bash
npm install
```

2. Compilar para producción:

```bash
npm run build
```

3. Renombrar ".env.example" a ".env" y configurar conexión a la base de datos

## Linux/macOS

```bash
cp .env.example .env
```

## REM Windows (CMD)

```bash
copy .env.example .env
```

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

4. Generar clave de app:

```bash
php artisan key:generate
```

5. Ejecutar migraciones:

```bash
php artisan migrate --seed
```

6. Ejecutar servidor local:

```bash
php artisan serve
```

6. Ingresa a http://localhost:8000 con los siguientes datos:

- ADMIN:

- Email: ivana@gmail.com
- Password: Admin123.

## Despliegue 📦

_notas adicionales sobre como hacer deploy_

## Construido con 🛠️

- [Laravel](https://laravel.com/) - El Framework web usado
- [jQuery](https://jquery.com/) - La Librería de front-end usada
- [Alpine.js](https://alpinejs.dev/) - La Librería de front-end usada
- [Bootstrap](https://getbootstrap.com/) - El Framework de CSS usado
- [Tailwind CSS](https://tailwindcss.com/) - El Framework de CSS usado
- [Composer](https://getcomposer.org/) - Manejador de dependencias para php
- [Npm](https://www.npmjs.com/) - Manejador de dependencias para JavaScript

## Autores ✒️

- **Ivana Galeno** - _Jefe de equipo/Desarrollo del software_ - [ivanamar12](https://github.com/ivanamar12)

## Colaboradores ✒️

- **Abraham Hernández** - _Desarrollo del software_ - [abranher](https://github.com/abranher)

## Licencia 📄

Este proyecto está bajo la Licencia [MIT license](https://opensource.org/licenses/MIT) - mira el archivo [LICENSE](LICENSE) para más detalles.
