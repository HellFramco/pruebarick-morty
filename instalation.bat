@echo off
:: ============ 1. CONFIGURACIÓN RÁPIDA ============
set "DB_NAME=rick_db"
set "DB_USER=root"
set "DB_PASS="        ::clave MySQL
set "DB_HOST=127.0.0.1"
set "PHP_EXE=php"
set "COMPOSER_CMD=composer"
set "MYSQL_CMD=mysql"


echo :: ============ 1. COMPOSER ============
echo        Instalando dependencias COMPOSER
echo :: ============ 1. COMPOSER ============
where %COMPOSER_CMD% >nul 2>&1
if errorlevel 1 (
    echo [ERROR] Composer no esta instalado o no esta en PATH.
    pause
    exit /b 1
)
call %COMPOSER_CMD% install --no-interaction
if errorlevel 1 (
    echo [ERROR] Composer fallo.
    pause
    exit /b 1
)


echo :: ============ 2. .ENV ============
echo        Instalando variables de entorno
echo :: ============ 2. .ENV ============
if not exist ".env" (
    copy ".env.example" ".env" >nul
    echo APP_KEY= >> .env
    echo.
    echo.env copiado desde .env.example
)


echo :: ============ 3. .Actualizando variables ============
echo        Actualizando variables de entorno
echo :: ============ 3. .Actualizando variables ============
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


echo :: ============ 4. Ejecutando migraciones ============
echo        Laravel key gen
echo :: ============ 4. Ejecutando migraciones ============
call %PHP_EXE% artisan key:generate 


echo :: ============ 5. Ejecutando migraciones ============
echo        Laravel BD generando
echo :: ============ 5. Ejecutando migraciones ============
call %PHP_EXE% artisan migrate


call %PHP_EXE% artisan serve

start http://127.0.0.1:8000/characters
