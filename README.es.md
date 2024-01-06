# Aplicación Web de Administración de Iglesias

Bienvenido al repositorio de la Aplicación Web de Administración de Iglesias. Esta aplicación web está diseñada para ayudar a gestionar varios aspectos de la administración de Iglesias, incluyendo la gestión de usuarios, eventos, seguimiento de ingresos y gestión de roles. Sigue el patrón arquitectónico Modelo-Vista-Controlador (MVC) para tener un código estructurado y fácil de mantener.

[English](./README.md) | [Español](./README.es.md) | [Français](./README.fr.md) | [日本語](./README.jp.md)

## Características

- **Gestión de Usuarios:** Crea y administra cuentas de usuarios para miembros y personal de la iglesia.

- **Gestión de Eventos:** Programa y administra eventos de la iglesia, incluyendo servicios, reuniones y ocasiones especiales.

- **Seguimiento de Ingresos:** Registra y sigue los ingresos de la iglesia, incluyendo diezmos, ofrendas y donaciones.

- **Gestión de Roles:** Asigna roles a miembros de la iglesia, como pastor, diácono y anciano.

-  **Gestión de Relaciones:** Registra y sigue las relaciones entre miembros de la iglesia, como familiares, amigos y compañeros.

## Estructura del Proyecto

El proyecto está estructurado siguiendo el patrón MVC:

- **Modelo:** Contiene interacciones con la base de datos, lógica de negocio y modelos de datos.

- **Vista:** Incluye la capa de presentación responsable de renderizar HTML e interfaces de usuario.

- **Controlador:** Gestiona la lógica central de la aplicación, maneja solicitudes y orquesta el flujo de datos.

- **Public:** Almacena activos públicos como CSS, JavaScript e imágenes.

- **Config:** Archivos de configuración para conexiones de base de datos y otras configuraciones.

- **Base de Datos:** Contiene scripts SQL para crear y poblar la base de datos.

## Instalación

1. Clona este repositorio en el directorio de tu servidor web:

    ```bash
    https://github.com/LeoMogiano/arqui_project.git
    ```

2. Instala XAMPP o WAMP para ejecutar la aplicación localmente.

3. Configura la conexión a la base de datos en los archivos `config/database.php` y `models/IglesiaDB.php`.

4. Inicia el servidor y abre la aplicación en tu navegador.

    ```bash
    php -S localhost:8080 -t public
    ```

## Capturas de Pantalla

*Pantalla*

<img loading="lazy" width="90%" src="./screenshots/s1.png" alt="Pantalla" />


## Contribución

¡Las contribuciones son bienvenidas! Si deseas contribuir a este proyecto, bifurca el repositorio, realiza tus cambios y envía una solicitud pull.

## Licencia

Este proyecto es de código abierto y está disponible bajo la [Licencia MIT](LICENSE). Eres libre de usarlo y modificarlo según tus necesidades de administración de Iglesias.

## Contacto

Si tienes alguna pregunta o necesitas ayuda, no dudes en ponerte en contacto con nosotros.

¡Disfruta usando la Aplicación Web de Administración de Iglesias!
