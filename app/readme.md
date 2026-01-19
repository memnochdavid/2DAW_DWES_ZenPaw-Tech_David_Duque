# 🐾 ZenPaw Tech - Mi Primer Blog en Symfony 8

¡Bienvenido a **ZenPaw Tech**! Este es un blog tecnológico minimalista desarrollado como parte del Seminario 1 de la asignatura de Desarrollo en Entorno Servidor.

## 🚀 Tecnologías Utilizadas

* **Framework:** Symfony 8.0 (PHP 8.2+)
* **Contenedores:** Docker & Docker Compose
* **Base de Datos:** PostgreSQL 16
* **Motor de Plantillas:** Twig (con estilos de [Pico.css](https://picocss.com/))
* **ORM:** Doctrine con Migrations y Fixtures

---

## 🛠️ Configuración del Entorno

Sigue estos pasos para levantar el proyecto en tu máquina local:

### 1. Levantar Docker
```bash
docker compose up -d
```
### 2. Instalar dependencias y preparar la DB
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate 
```
### 3. Cargar datos de prueba (Fixtures)
```bash
composer require --dev doctrine/doctrine-fixtures-bundle
php bin/console doctrine:fixtures:load --no-interaction
```

### 4. Iniciar el servidor de Symfony
```bash
symfony server:start -d
```

### Accede a http://localhost:8000 para ver el blog.

