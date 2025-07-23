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
git clone https://github.com/matiasletelierc/sistema-gestion-proyectos-laravel.git
cd sistema-gestion-proyectos-laravel
```

### 2. Instala las dependencias
Necesitas tener **PHP 8.2+** y **Composer** instalados:
```bash
composer install
npm install
```

### 3. Configura el archivo de entorno
```bash
# En Windows
copy .env.example .env

# En Linux/Mac
cp .env.example .env

# Genera la clave de aplicación
php artisan key:generate
```

### 4. Ejecuta las migraciones
```bash
php artisan migrate
```

### 5. Construye los assets (opcional)
```bash
npm run build
```

### 6. Inicia el servidor
```bash
php artisan serve
```

El proyecto estará disponible en `http://localhost:8000`

## 📋 Requisitos del Sistema

Para ejecutar este proyecto necesitas:

- **PHP 8.2 o superior**
- **Composer** (gestor de dependencias PHP)
- **Node.js y npm** (para assets, opcional)
- **Extensiones PHP requeridas:**
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON
  - BCMath
  - Fileinfo

### Instalación de Requisitos

#### Windows (XAMPP recomendado)
1. Descargar [XAMPP](https://www.apachefriends.org/download.html) con PHP 8.2+
2. Descargar [Composer](https://getcomposer.org/download/)
3. Descargar [Node.js](https://nodejs.org/) (opcional)

#### Ubuntu/Debian
```bash
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-zip php8.2-sqlite3
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### macOS
```bash
brew install php@8.2 composer node
```

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

## 🚀 Demo Rápido

Una vez que tengas el servidor ejecutándose (`php artisan serve`):

1. **Dashboard**: Ve a `http://localhost:8000` - Página principal
2. **Proyectos**: `http://localhost:8000/projects` - Lista de proyectos
3. **Crear Proyecto**: `http://localhost:8000/projects/create` - Nuevo proyecto
4. **Componente UF**: `http://localhost:8000/uf` - Valor actual de la UF
5. **API**: `http://localhost:8000/api/projects` - Endpoints REST

## 🛠️ Solución de Problemas

### Error: "Class 'PDO' not found"
Instala la extensión PDO para SQLite:
```bash
# Ubuntu/Debian
sudo apt install php8.2-sqlite3

# Windows (XAMPP)
# Descomenta ;extension=pdo_sqlite en php.ini
```

### Error: "The only supported ciphers are AES-128-CBC and AES-256-CBC"
```bash
php artisan key:generate
```

### Error: "file_get_contents(): SSL operation failed"
El servicio de UF requiere conexión a internet. En desarrollo local funciona sin problemas.

### Problemas con estilos CSS
Los estilos glassmorphism requieren navegadores modernos con soporte para `backdrop-filter`.

## 📱 Compatibilidad

- **Navegadores**: Chrome 76+, Firefox 103+, Safari 14+
- **PHP**: 8.2, 8.3
- **Base de datos**: SQLite (incluida), MySQL, PostgreSQL
- **Responsive**: Móvil, tablet, desktop

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
