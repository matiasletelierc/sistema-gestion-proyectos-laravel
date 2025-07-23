# Sistema de Gestión de Proyectos Laravel

Un sistema moderno de gestión de proyectos desarrollado en Laravel con diseño glassmorphism e integración de servicios externos.

## Características

- ✅ **CRUD Completo de Proyectos**: Crear, ver, editar y eliminar proyectos
- ✅ **Integración UF**: Obtención automática del valor de la UF desde mindicador.cl
- ✅ **Diseño Moderno**: Interfaz glassmorphism con efectos visuales avanzados
- ✅ **Sistema de Notificaciones**: Notificaciones en tiempo real para acciones del usuario
- ✅ **API REST**: Endpoints para integración con otras aplicaciones
- ✅ **Base de Datos**: SQLite incluida con migraciones configuradas

## Tecnologías Utilizadas

- **Laravel 11**: Framework PHP moderno
- **PHP 8.2+**: Lenguaje de programación
- **SQLite**: Base de datos ligera
- **Glassmorphism CSS**: Diseño moderno con efectos de cristal
- **API Externa**: Integración con mindicador.cl para valores UF

## Instalación y Configuración

### 1. Clona el repositorio
```bash
git clone https://github.com/tu-usuario/sistema-gestion-proyectos.git
cd sistema-gestion-proyectos
```

### 2. Instala las dependencias
```bash
composer install
npm install
```

### 3. Configura el archivo de entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Ejecuta las migraciones
```bash
php artisan migrate
```

### 5. Construye los assets
```bash
npm run build
```

### 6. Inicia el servidor
```bash
php artisan serve
```

El proyecto estará disponible en `http://localhost:8000`

## Estructura del Proyecto

### Modelos
- `Project`: Modelo principal para gestión de proyectos

### Controladores
- `ProjectController`: CRUD completo de proyectos
- `UfController`: Gestión del componente UF
- `Api/ProjectApiController`: API REST para proyectos

### Servicios
- `UFService`: Integración con API externa de mindicador.cl

### Vistas
- **Dashboard**: Página principal con estadísticas
- **Proyectos**: Lista completa de proyectos
- **Crear Proyecto**: Formulario de creación
- **Editar Proyecto**: Formulario de edición
- **Ver Proyecto**: Detalles del proyecto
- **Componente UF**: Valor actual de la UF

## API Endpoints

### Proyectos
- `GET /api/projects` - Lista todos los proyectos
- `POST /api/projects` - Crea un nuevo proyecto
- `GET /api/projects/{id}` - Obtiene un proyecto específico
- `PUT /api/projects/{id}` - Actualiza un proyecto
- `DELETE /api/projects/{id}` - Elimina un proyecto

### UF
- `GET /uf` - Obtiene el valor actual de la UF

## Características del Diseño

- **Glassmorphism**: Efectos de cristal modernos
- **Responsivo**: Adaptable a todos los dispositivos
- **Animaciones**: Transiciones suaves y efectos visuales
- **Tipografía**: Fuentes Inter y Poppins
- **Notificaciones**: Sistema de alerts en tiempo real

## Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -m 'Agrega nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
