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

### 2. Configurar variables de entorno

#### a) Variables para Docker Compose (opcional)
En la raíz del proyecto puedes crear un archivo `.env` (ignorado por Git) para personalizar las credenciales de MySQL que lee [docker-compose.yml](docker-compose.yml):

```env
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
DB_ROOT_PASSWORD=toor
```

*(Si no existe `.env` en la raíz, `docker-compose.yml` usa por defecto `laravel` / `laravel` / `secret` / `toor`.)*

#### b) Variables de Laravel (`html/.env`)
Copia la plantilla de entorno de Laravel dentro de `html/`:

```bash
cp html/.env.example html/.env
```

Asegúrate de configurar la conexión hacia el servicio `mysql` en `html/.env` (usando los mismos valores definidos para el contenedor MySQL):

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### 3. Construir y levantar los contenedores

```bash
docker compose up -d --build
```

Comprueba que ambos contenedores están activos (`laravel_app` en el puerto `8181` y `laravel_mysql` en el `3306`):

```bash
docker compose ps
```

### 4. Instalar dependencias y preparar Laravel

Ejecuta dentro del contenedor `app`:

```bash
docker compose exec app composer install
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
