<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

🔧 Sistema de Gestión de Pagos a Proveedores — Ferretería San Juan

Aplicación de escritorio para administrar las **facturas y los pagos pendientes a proveedores** de una ferretería. Permite llevar el control de adeudos, registrar abonos y dar seguimiento a las fechas de vencimiento, todo desde una interfaz sencilla y clara.

> Proyecto desarrollado con Laravel + Electron (vía NativePHP), pensado para funcionar como un programa de escritorio.

---

## 📋 ¿Qué hace la aplicación?

- **Gestión de proveedores:** alta, edición y consulta de proveedores, con sus datos de contacto y el adeudo total acumulado.
- **Gestión de facturas:** registro de facturas por proveedor, con folio, monto, fecha de emisión y fecha de vencimiento.
- **Registro de pagos:** se pueden registrar abonos parciales o totales contra cada factura.
- **Cálculo automático de saldos:** el saldo de cada factura y el estatus (*pendiente*, *parcial* o *pagada*) se calculan solos a partir de los pagos registrados.
- **Dashboard de control:** muestra el adeudo total, las facturas vencidas y las próximas a vencer en los siguientes 7 días.
- **Inicio de sesión:** acceso protegido con usuario y contraseña, para que solo el dueño pueda entrar.

---

## 🛠️ Tecnologías utilizadas

| Tecnología | Para qué se usó |
|---|---|
| **Laravel 12** (PHP) | Framework principal: lógica, rutas, base de datos |
| **NativePHP / Electron** | Convierte la app Laravel en un programa de escritorio |
| **SQLite / MySQL** | Base de datos donde se guarda todo |
| **Blade** | Sistema de plantillas para las pantallas |
| **Bootstrap 5** | Estilos base de la interfaz |
| **CSS personalizado** | Identidad visual de la ferretería (negro, blanco y rojo) |

---

## 🗂️ Cómo está organizado el proyecto

El proyecto sigue el patrón **MVC** (Modelo - Vista - Controlador), que separa la lógica en tres capas:

```
app/
├── Models/              → Representan los datos (Proveedor, Factura, Pago)
└── Http/Controllers/    → La lógica: reciben las peticiones y responden

resources/views/         → Las pantallas que ve el usuario (archivos .blade.php)

routes/web.php           → Define qué dirección (URL) lleva a qué función

database/migrations/     → Los "planos" de las tablas de la base de datos

public/css/app.css       → Los estilos y colores de la app
```
