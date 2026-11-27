<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">NovaTech — Despliegue Docker + Laravel</h1>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.3--apache-777BB4?logo=php&logoColor=white" alt="PHP 8.3 Apache">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?logo=laravel&logoColor=white" alt="Laravel 13">
  <img src="https://img.shields.io/badge/MySQL-8.4-4479A1?logo=mysql&logoColor=white" alt="MySQL 8.4">
  <img src="https://img.shields.io/badge/Docker-Compose-2496ED?logo=docker&logoColor=white" alt="Docker Compose">
  <img src="https://img.shields.io/badge/License-MIT-79B729" alt="License: MIT">
</p>

## Acerca del proyecto

**NovaTech** es una aplicación web desarrollada sobre **Laravel 13** y desplegada en contenedores **Docker** con **PHP 8.3 + Apache** y **MySQL 8.4**. El proyecto presenta la landing corporativa de NovaTech (*Digitaliza Fácil* y *Business Copilot IA*), orientada a la digitalización presencial y acompañamiento de pequeños negocios y comercios locales.

### Stack y estructura

- **Aplicación web (`app` / `laravel_app`):** construida a partir de [docker/php/Dockerfile](docker/php/Dockerfile) (`php:8.3-apache`, extensiones `pdo_mysql`, `mbstring`, `zip`, `exif`, `pcntl`, `bcmath`, `intl`, `gd`, `mod_rewrite` habilitado, `DocumentRoot` en `/var/www/html/public` y Composer 2).
- **Base de datos (`mysql` / `laravel_mysql`):** `mysql:8.4` con volumen persistente `mysql_data`.
- **Código Laravel:** ubicado en [html/](html/).

---

## Guía de despliegue con Docker

### Requisitos previos

- [Docker](https://docs.docker.com/get-docker/) y **Docker Compose** (`docker compose`).
- [Git](https://git-scm.com/).

### 1. Clonar el repositorio

```bash
git clone git@github.com:reptilAndaluz/NovaTech.git
cd NovaTech
```

### 2. Configurar variables de entorno (`.env`)

El repositorio incluye plantillas `.env.example` (los archivos `.env` reales están ignorados por Git para no subir credenciales). Debes configurar dos archivos y asegurarte de que las credenciales de base de datos coinciden en ambos:

#### a) `.env` en la raíz (para Docker Compose)
Copia la plantilla de la raíz:

```bash
cp .env.example .env
```

Edita `.env` y define el nombre de la base de datos, el usuario y las contraseñas (no dejes `DB_PASSWORD` ni `DB_ROOT_PASSWORD` vacíos o MySQL no arrancará):

```env
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=tu_password_segura
DB_ROOT_PASSWORD=tu_root_password_segura
```

*(Si no creas `.env` en la raíz, `docker-compose.yml` usará por defecto `laravel` / `laravel` / `secret` / `toor`.)*

#### b) `html/.env` (para Laravel)
Copia la plantilla de entorno de Laravel dentro de `html/`:

```bash
cp html/.env.example html/.env
```

Edita `html/.env` para que `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` coincidan exactamente con los de la raíz (si la contraseña tiene espacios, envuélvela entre comillas dobles `"..."`). El campo `APP_KEY=` se rellenará automáticamente en el paso 4 con `php artisan key:generate`:

```env
APP_NAME=NovaTech
APP_URL=http://localhost:8181

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=tu_password_segura
```

> **Importante:** cambia las contraseñas en ambos `.env` **antes** de ejecutar `docker compose up` por primera vez, ya que MySQL solo crea el usuario y la contraseña cuando se inicializa el volumen `mysql_data`.

### 3. Construir y levantar los contenedores

```bash
docker compose up -d --build
```

Comprueba que ambos contenedores están activos (`laravel_app` en el puerto `8181` y `laravel_mysql` en el `3306`):

```bash
docker compose ps
```

### 4. Instalar dependencias, configurar permisos y preparar Laravel

Ejecuta dentro del contenedor `app`:

```bash
docker compose exec app composer install
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
docker compose exec app chmod -R 775 storage bootstrap/cache
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

### 5. Acceder a la aplicación

Abre en tu navegador:

- **Web:** http://localhost:8181

---

## Comandos útiles

| Acción | Comando |
| --- | --- |
| Levantar servicios en segundo plano | `docker compose up -d` |
| Ver logs en tiempo real | `docker compose logs -f` |
| Entrar al contenedor PHP/Apache | `docker compose exec app bash` |
| Ejecutar comandos Artisan | `docker compose exec app php artisan <comando>` |
| Limpiar cachés de Laravel | `docker compose exec app php artisan optimize:clear` |
| Detener los contenedores | `docker compose down` |
| Detener y eliminar también volúmenes (borra BD) | `docker compose down -v` |

---

## Solución de problemas frecuentes

- **Error de permisos en `storage/` o `bootstrap/cache/` (`Permission denied` en la web):**
  Apache corre dentro del contenedor como `www-data`. Asegúrate de darle permisos de escritura a esas carpetas:
  ```bash
  docker compose exec app chown -R www-data:www-data storage bootstrap/cache
  docker compose exec app chmod -R 775 storage bootstrap/cache
  ```
- **Error de permisos al ejecutar `docker` (`permission denied while trying to connect to the Docker daemon socket`):**
  Añade tu usuario al grupo `docker` y recarga la sesión:
  ```bash
  sudo usermod -aG docker $USER
  newgrp docker
  ```
- **Error de permisos al editar archivos en `html/` o usar `git` en el equipo anfitrión:**
  Los archivos creados desde el contenedor (`composer`, `artisan`) pueden quedar como `root:root`. Devuelve la propiedad a tu usuario y restaura los permisos de escritura de Laravel:
  ```bash
  sudo chown -R $USER:$USER html/
  docker compose exec app chown -R www-data:www-data storage bootstrap/cache
  docker compose exec app chmod -R 775 storage bootstrap/cache
  ```
- **Conflicto de nombre de contenedor (`laravel_mysql` o `laravel_app` ya está en uso):**
  Si otro proyecto Docker dejó un contenedor con el mismo `container_name`, elimínalo (`docker rm laravel_mysql`) o cambia/elimina `container_name` en [docker-compose.yml](docker-compose.yml).
- **Error `SQLSTATE[HY000] [1045] Access denied`:**
  MySQL solo inicializa el usuario y la contraseña la **primera vez** que se crea el volumen `mysql_data`. Asegúrate de que `DB_PASSWORD` en `html/.env` coincide con la contraseña con la que se creó el volumen (o recrea el volumen con `docker compose down -v && docker compose up -d` si no necesitas conservar datos previos).
- **Error 403 al añadir imágenes o archivos nuevos en sistemas con SELinux (Fedora/RHEL):**
  El volumen `./html:/var/www/html:z` utiliza etiquetado SELinux (`container_file_t`). Si mueves archivos con `mv` desde tu carpeta personal, puede conservar la etiqueta `user_home_t`. Usa `cp` al copiarlos o restablece el contexto con:
  ```bash
  chcon -R -t container_file_t html/public/assets/
  ```

---

## Equipo

- **Raúl Gorlat Castro**
- **Adrián Burgos Tomé**
- **José Sánchez Sorroche**

## Documentación de Laravel

Para profundizar en el framework consulta la [documentación oficial de Laravel](https://laravel.com/docs) y [Laracasts](https://laracasts.com).

## Licencia

Este proyecto se distribuye bajo la [licencia MIT](LICENSE).
