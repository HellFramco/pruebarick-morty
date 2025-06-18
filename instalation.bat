@echo off
:: ────────────────────────────────────────────────
:: Laravel First‑Run Setup Script  (Windows / XAMPP)
:: put this file inside your project root and run it
:: ────────────────────────────────────────────────

:: ============ 1. CONFIGURACIÓN RÁPIDA ============
set "DB_NAME=rick_db"
set "DB_USER=root"
set "DB_PASS="        ::clave MySQL
set "DB_HOST=127.0.0.1"
set "PHP_EXE=php"
set "COMPOSER_CMD=composer"
set "MYSQL_CMD=mysql"

echo.
echo    Instalando dependencias COMPOSER
echo.

:: ============ 2. COMPOSER ============ 
where %COMPOSER_CMD% >nul 2>&1
if errorlevel 1 (
    echo [ERROR] Composer no esta instalado o no esta en PATH.
    pause
    exit /b 1
)
%COMPOSER_CMD% install
if errorlevel 1 (
    echo [ERROR] Composer fallo.
    pause
    exit /b 1
)

:: ============ 3. .ENV ============ 
if not exist ".env" (
    copy ".env.example" ".env" >nul
    echo APP_KEY= >> .env
    echo.
    echo ➤ .env copiado desde .env.example
)

:: Actualizar datos de BD en .env
(for /f "delims=" %%A in ('type .env') do (
    echo %%A| findstr /r "DB_DATABASE=" >nul && (
        echo DB_DATABASE=%DB_NAME%
    ) || (
    echo %%A| findstr /r "DB_USERNAME=" >nul && (
        echo DB_USERNAME=%DB_USER%
    ) || (
    echo %%A| findstr /r "DB_PASSWORD=" >nul && (
        echo DB_PASSWORD=%DB_PASS%
    ) || (
        echo %%A
    )))
))> .env.tmp
move /y .env.tmp .env >nul

:: ============ 4. GENERAR APP KEY ============
%PHP_EXE% artisan key:generate 

:: ============ 5. CREAR BASE DE DATOS ============
echo.
echo ➤ Creando base de datos (si no existe)...
echo.
"%MYSQL_CMD%" -u%DB_USER% -p%DB_PASS% -e "CREATE DATABASE IF NOT EXISTS %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
if errorlevel 1 (
    echo [ADVERTENCIA] No se pudo crear la BD automaticamente. Crea %DB_NAME% manualmente si ya existe este mensaje se puede ignorar.
)

:: ============ 6. MIGRACIONES ============
%PHP_EXE% artisan migrate
if errorlevel 1 (
    echo [ERROR] Fallo migrate.
    pause
    exit /b 1
)

echo.
echo ────────────────────────────────────────────────
echo   ✅ Instalacion completa. Ejecuta:
echo      php artisan serve
echo   y abre http://127.0.0.1:8000
echo ────────────────────────────────────────────────
pause
