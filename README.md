# Inventario
> Proyecto final del curso de Symfony

## Requerimientos
1. Composer
2. PHP > 7.0

#### Este Proyecto fue creado con el framework symfony 3.1 LTS
A Symfony project created on April 11, 2018, 2:05 am.

## Instalación
1. Instalar las dependencias del proyecto
```sh
composer install
```

2. Crear una base de datos en MYSQL llamada inventario
```sql
CREATE DATABASE inventario 
```

3. Generar la Base de Datos MySql
```sh
php bin/console doctrine:schema:update --force
``` 

4. Ejecutar Proyecto
```sh
php bin/console server:run
``` 

5. Ingresar a la url:
> *localhost:8000* [Entrar](http://localhost:8000)

# Tips de consola
1. Generar entidades y sus atributos

```sh
php bin/console doctrine:generate:entity
``` 

2. Generar getters y setters de las entidades

```sh
php bin/console doctrine:generate:entities AppBundle
``` 

3. Actualizar el esquema de la Base de Datos

```sh
php bin/console doctrine:schema:update --force
``` 

