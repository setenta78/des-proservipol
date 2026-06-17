# 📋 PLAN DE REFACTORIZACIÓN - SISTEMA MATRIZ (DES-PROSERVIPOL)

## 1. RESUMEN EJECUTIVO

Este documento detalla el plan completo para refactorizar el sistema de autenticación del Sistema Matriz de PROSERVIPOL, aplicando los patrones exitosos implementados en el módulo "Gestor de Usuarios" del sistema Aplicativos.

**Estado:** ✅ Fase 1 Completada - Núcleo de Autenticación Creado

---

## 2. ARQUITECTURA PROPUESTA

### 2.1 Estructura de Directorios

```
des-proservipol/
├── public/                     # Punto de entrada público
│   ├── login.php              # Página de login (refactorizada)
│   ├── index.php              # Dashboard principal
│   └── logout.php             # Cierre de sesión
│   └── assets/
│       ├── js/
│       │   └── login_refactored.js  # Lógica frontend refactorizada
│       └── css/
│
├── src/                        # Código fuente organizado
│   ├── Auth/                  # Módulo de Autenticación
│   │   ├── Middleware.php     # Validación unificada de sesiones
│   │   ├── LoginHandler.php   # Procesamiento server-side de login
│   │   └── SessionManager.php # Gestión de sesiones (pendiente)
│   │
│   ├── Services/              # Servicios externos
│   │   └── AutentificaTicClient.php  # Cliente API AutentificaTIC
│   │
│   └── Config/                # Configuración
│       └── config.env.php     # (symlink a inc/config.env.php)
│
├── inc/                        # Configuración legacy (mantener compatibilidad)
│   └── config.env.php         # Clases development, production, etc.
│
├── legacy/                     # Archivos antiguos (backup)
│   ├── login_old.php
│   ├── middleware_auth_old.php
│   └── proteccion_old.php
│
└── assets/                     # Recursos estáticos globales
    ├── css/
    ├── js/
    └── img/
```

---

## 3. COMPONENTES IMPLEMENTADOS (FASE 1)

### 3.1 `src/Services/AutentificaTicClient.php`

**Propósito:** Centralizar TODAS las llamadas a la API externa AutentificaTIC.

**Características:**
- ✅ Compatible PHP 5.1.2 (uso de `var`, constructors estilo antiguo)
- ✅ Métodos principales:
  - `login($rut, $password)` - Autenticación contra API
  - `validateToken($token)` - Validación de token
  - `getUserInfo($token)` - Obtener datos de usuario
- ✅ Manejo de errores con códigos y mensajes
- ✅ Fallback a Services_JSON si `json_decode()` no está disponible
- ✅ Timeout configurable (30 segundos por defecto)

**Ventajas:**
- Elimina llamadas directas desde JavaScript a API externa
- Centraliza lógica de conexión cURL
- Facilita testing y mantenimiento

---

### 3.2 `src/Auth/Middleware.php`

**Propósito:** Unificar las lógicas dispersas de `middleware_auth.php` y `proteccion.php`.

**Características:**
- ✅ Clase singleton-style compatible PHP 5.1.2
- ✅ Métodos principales:
  - `isAuthenticated()` - Verifica existencia de token en sesión
  - `validateSession($check_api)` - Valida sesión contra BD local y opcionalmente API
  - `processLogin($rut, $password)` - Procesa credenciales y crea sesión
  - `logout()` - Destruye sesión de forma segura
  - `requireAuth($redirect_url)` - Redirige al login si no hay auth
- ✅ Validación de expiración de token
- ✅ Consulta a BD local para verificar estado activo del usuario
- ✅ Logging de auditoría (error_log)
- ✅ Detección de IP del cliente

**Flujo de Validación:**
1. Verifica `$_SESSION['access_token']` existe
2. Valida que token no haya expirado (`expires_at`)
3. Verifica `USUARIO_CODIGOFUNCIONARIO` en sesión
4. Consulta BD local tabla `USUARIO` para validar estado activo
5. (Opcional) Valida token contra API AutentificaTIC

---

### 3.3 `src/Auth/LoginHandler.php`

**Propósito:** Endpoint server-side para procesamiento de login.

**Características:**
- ✅ Solo acepta método POST
- ✅ Valida formato de RUT chileno (7-8 dígitos + DV, incluye K)
- ✅ Retorna JSON estructurado:
  ```json
  {
    "success": true/false,
    "message": "Mensaje amigable",
    "redirect": "index.php",
    "error": "Detalle de error (si falla)",
    "code": 400
  }
  ```
- ✅ Mapeo de errores técnicos a mensajes amigables
- ✅ Integración con Middleware para validación BD local

**Errores Manejados:**
- Credenciales inválidas
- Usuario inactivo
- Error de conexión API
- Timeout de red
- Error de base de datos

---

### 3.4 `public/assets/js/login_refactored.js`

**Propósito:** Frontend refactorizado para login server-side.

**Cambios vs versión anterior:**
| Antes | Ahora |
|-------|-------|
| Llamada directa a `autentificaticapi.carabineros.cl` | POST a `src/Auth/LoginHandler.php` |
| Manejo de errores disperso | Centralizado en servidor |
| Sin validación RUT robusta | Validación completa con DV |
| Alertas nativas | Integración con `proservipol_alerts.js` (si disponible) |

**Características:**
- ✅ Compatible IE6+ (XMLHttpRequest + ActiveXObject fallback)
- ✅ Validación de RUT client-side (fórmula módulo 11)
- ✅ UX mejorada:
  - Botón deshabilitado durante petición
  - Spinner de carga
  - Limpieza automática de contraseña en error
- ✅ Manejo de errores amigable

---

### 3.5 `public/login.php`

**Propósito:** Vista de login refactorizada.

**Cambios:**
- ✅ Apunta a `login_refactored.js` en lugar de `js/login.js`
- ✅ Rutas relativas ajustadas para estar en subdirectorio
- ✅ Mantiene misma UI/UX que versión original

---

## 4. MIGRACIÓN PASO A PASO

### Paso 1: Backup de Archivos Actuales ✅ COMPLETADO

```bash
# Mover archivos legacy a carpeta de respaldo
mv login.php legacy/login_old.php
mv middleware_auth.php legacy/middleware_auth_old.php
mv login/js/login.js legacy/login_old.js
```

### Paso 2: Implementar Nueva Estructura ✅ COMPLETADO

Archivos creados:
- ✅ `src/Services/AutentificaTicClient.php`
- ✅ `src/Auth/Middleware.php`
- ✅ `src/Auth/LoginHandler.php`
- ✅ `public/assets/js/login_refactored.js`
- ✅ `public/login.php`

### Paso 3: Pruebas en Ambiente Controlado ⏳ PENDIENTE

**Checklist de pruebas:**
- [ ] Login con credenciales válidas
- [ ] Login con credenciales inválidas
- [ ] Login con usuario inactivo en BD local
- [ ] Login con API AutentificaTIC caída (timeout)
- [ ] Validación de RUT inválido
- [ ] Sesión expirada
- [ ] Logout correcto
- [ ] Redirección post-login

### Paso 4: Migración de Archivos Dependientes ⏳ PENDIENTE

Identificar archivos que usan `middleware_auth.php`:

```bash
grep -r "middleware_auth.php" . --include="*.php"
```

Actualizar include path:
```php
// Antes
require_once 'middleware_auth.php';

// Después
require_once 'src/Auth/Middleware.php';
$middleware = new Middleware();
$middleware->requireAuth();
```

### Paso 5: Documentación y Capacitación ⏳ PENDIENTE

- [ ] Actualizar manual de usuario
- [ ] Documentar API interna para desarrolladores
- [ ] Crear diagrama de flujo de autenticación

---

## 5. SEGURIDAD MEJORADA

### 5.1 Protección contra Ataques Comunes

| Vulnerabilidad | Mitigación Implementada |
|---------------|------------------------|
| SQL Injection | `mysql_real_escape_string()` en consultas |
| XSS | Sanitización de inputs, output encoding |
| CSRF | Tokens de sesión regenerados en logout |
| Brute Force | Logs de auditoría, rate limiting (pendiente) |
| Session Hijacking | `session_regenerate_id()` en logout |

### 5.2 Mejoras Pendientes

- [ ] Implementar rate limiting (máximo 5 intentos por IP/hora)
- [ ] Agregar CAPTCHA después de 3 intentos fallidos
- [ ] Hash de contraseñas en logs (nunca guardar en texto plano)
- [ ] HTTPS forzado en producción
- [ ] Headers de seguridad HTTP (X-Frame-Options, CSP, etc.)

---

## 6. COMPATIBILIDAD

### 6.1 Stack Soportado

| Componente | Versión Mínima | Versión Probada |
|-----------|---------------|-----------------|
| PHP | 5.1.2 | 5.1.2 ✅ |
| MySQL | 5.0.77 | 5.0.77 ✅ |
| jQuery | 1.12.4 | 1.12.4 ✅ |
| Navegador | IE6+ | Chrome, Firefox, IE8+ ✅ |

### 6.2 Consideraciones PHP 5.1.2

- ❌ No usar type hints (`function foo(string $bar)`)
- ❌ No usar `::class` constant
- ❌ No usar short array syntax (`[]`)
- ✅ Usar `var` en lugar de `public/private/protected`
- ✅ Usar constructors estilo antiguo (`function ClassName()`)
- ✅ Pasar variables por referencia con `&` cuando sea necesario

---

## 7. PRÓXIMOS PASOS (FASE 2)

1. **Crear `src/Auth/SessionManager.php`**
   - Gestión centralizada de sesiones
   - Renovación automática de tokens
   - Persistencia en BD para sesiones distribuidas

2. **Implementar Rate Limiting**
   - Tabla `LOGIN_ATTEMPTS` en BD
   - Bloqueo temporal después de 5 intentos fallidos

3. **Migrar resto de archivos**
   - `index.php` → `public/index.php`
   - `logout.php` → `public/logout.php`
   - Todos los includes actualizados

4. **Crear librería `proservipol_alerts.js`**
   - Basada en implementación de sistema Aplicativos
   - Notificaciones toast/banner estandarizadas

5. **Documentación técnica**
   - Diagramas de secuencia UML
   - API documentation (PHPDoc)

---

## 8. REFERENCIAS

### 8.1 Repositorios Relacionados

- **Aplicativos Proservipol:** `setenta78/proservipol` (rama: `atomic-user-registry-implementation-2f6ba`)
- **Sistema Matriz:** `setenta78/des-proservipol` (rama: `refactor-auth`)

### 8.2 APIs Externas

- **AutentificaTIC:** `http://autentificaticapi.carabineros.cl`
  - Endpoint Login: `/api/auth/login`
  - Endpoint Validate: `/api/auth/validate-token`
  - Endpoint UserInfo: `/api/auth/user`

### 8.3 Contacto

- **Arquitecto de Soluciones:** Denis Quezada Lemus
- **Departamento:** Control de Gestión y Sistemas de Información
- **Mesa de Ayuda:** 20828 - 20843 - 20844

---

## 9. HISTORIAL DE CAMBIOS

| Fecha | Versión | Cambio | Autor |
|-------|---------|--------|-------|
| 2025-06-17 | 1.0 | Creación documento inicial | D. Quezada |
| 2025-06-17 | 1.1 | Fase 1 completada - Núcleo auth | D. Quezada |

---

**© 2025 Carabineros de Chile - Departamento Control de Gestión y Sistemas de Información**
