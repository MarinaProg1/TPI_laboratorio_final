### UTN Online

## Descripción:

Este proyecto es una tienda online desarrollada como trabajo académico para la facultad. La plataforma permite a los usuarios navegar por diversas categorías de productos, añadir artículos al carrito de compras y realizar pedidos de manera sencilla.

El objetivo principal del proyecto es aplicar conceptos de desarrollo web, bases de datos y gestión de información en un entorno realista, simulando el funcionamiento de un comercio electrónico.

## Características principales:

Exploración de productos organizados por categorías.

Gestión de carrito de compras y realización de pedidos.

Tecnologías utilizadas:

Frontend: HTML, CSS, JavaScript.

Backend: Laravel / PHP.

Base de datos: MySQL.

Control de versiones: Git y GitHub.

## El grupo del proyecto esta integrado por :

Juan Cruz Correa

Federico Vicentin

Marina Lopez

## Funcionalidades principales:

Gestión de usuarios:

Registro seguro de usuarios: Los datos se almacenan y manejan con prácticas seguras, incluyendo encriptación de contraseñas.

Autenticación de usuarios: Los usuarios pueden iniciar sesión para acceder a funcionalidades personalizadas.

## Roles de usuario:

Usuarios regulares: Pueden navegar, agregar productos al carrito y realizar compras.

Administradores: Acceden a funcionalidades adicionales como el ABM (Alta, Baja, Modificación) de productos y administración de categorías.

## Funcionalidades para usuarios:

Vista de productos:

Listado completo de productos disponibles.

Filtros por categorías para facilitar la búsqueda.

Carrito de compras:

Agregar productos al carrito.

Modificar la cantidad de productos seleccionados directamente desde el carrito.

Eliminar productos del carrito si así lo desean.

Visualización del total acumulado de la compra en tiempo real.

## Funcionalidades para administradores:

ABM de productos: Los administradores pueden gestionar el catálogo, agregando, editando o eliminando productos.

Gestión de categorías: Los administradores pueden administrar las categorías disponibles para los productos.

### Configuración del proyecto

## Instalar las dependencias:

composer install

npm install

npm run dev

## Configurar el entorno:

cp .env.example .env

# Ejecutar migraciones y seeders:

php artisan migrate --seed

Nota: Los seeders crean ejemplos de usuarios comunes y un administrador con las siguientes credenciales:

Email del administrador:adminUtn@gmail.com

Contraseña:123456

Ejemplo de un usuario comun:

Email del administrador:usuarioUno@gmail.com

Contraseña:123456

# Hacer accesibles las imágenes:

Ejecuta el comando para crear el enlace simbólico entre el directorio de almacenamiento y la carpeta pública:

php artisan storage:link

## Objetivo del proyecto

El objetivo principal de este proyecto es aplicar los conceptos aprendidos en el curso para desarrollar una aplicación web moderna que integre buenas prácticas de programación, diseño responsivo y funcionalidades de e-commerce.
