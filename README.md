# Nombre del Proyecto

## Configuración

Antes de comenzar, asegúrate de configurar las siguientes variables de entorno en un archivo `.env`:

- `LIST_TABLE_USERS`: Debe contener la URL o endpoint para listar usuarios.
- `GET_USERS`: Debe contener la URL o endpoint para obtener detalles de un usuario.
- `SEND_USER`: Debe contener la URL o endpoint para enviar datos de usuario.

Puedes encontrar un ejemplo de configuración en el archivo `.env.example`.

## Instalación

1. **Clonar el Repositorio:**
    ```bash
    git clone https://github.com/nol4lej/hofmann-pruebatecnica
    cd hofmann-pruebatecnica
    ```
2. Instalar Dependencias PHP
    ```bash
    composer install
    ```
3. Instalar Dependencias JavaScript:
    ```bash
    npm install
    ```
4. Compilar Assets:
    ```bash
    npm run dev
    ```
## Ejecutar el Proyecto

Para ejecutar el proyecto en un entorno local, utiliza el siguiente comando:
    ```bash
    php artisan serve
    ```

El proyecto estará disponible en `http://localhost:8000`.