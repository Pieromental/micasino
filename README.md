# Proyecto MiCasinoTest

Este repositorio contiene dos carpetas principales que representan dos implementaciones distintas:

* `laravel-test/`
* `vue-test/`

Cada una representa una parte del sistema modular solicitado en la prueba de MiCasino.

---

## 📌 Enunciado de las pruebas

* Frontend: [https://github.com/micasino/vue-test](https://github.com/micasino/vue-test)
* Backend: [https://github.com/micasino/laravel-test](https://github.com/micasino/laravel-test)

---

## 📂 Estructura General

### 1. `vue-test/`

Contiene un frontend en Vue 3 + Vite, donde se desarrolla un formulario modular basado en definiciones de campos.

#### ⚡ Tecnologías:

* Vue 3
* Composition API
* Vite

---

### 2. `laravel-test/`

Contiene el backend en Laravel para procesar transacciones simuladas con EasyMoney y SuperWallet. Incluye manejo de colas para ejecución de trabajos.

---

## 🚀 Comandos para levantar los proyectos

### 🔧 Laravel Backend (configuración completa)

```bash
cd laravel-test
cp .env.example .env
php artisan key:generate
```

Edita el archivo `.env` y asegúrate de tener lo siguiente:

```env
DB_CONNECTION=sqlite
QUEUE_CONNECTION=database
```

Luego ejecuta:

```bash
php artisan migrate --seed
php artisan queue:table
php artisan migrate
php artisan serve
php artisan queue:work --daemon
```

Para reiniciar los workers y reflejar cambios:

```bash
php artisan queue:restart
```

### 🔧 Vue Frontend

```bash
cd vue-test
npm install
npm run dev
```

---

## 📌 Otros comandos útiles

Ver trabajos fallidos:

```bash
php artisan queue:failed
```

Reintentar trabajos fallidos:

```bash
php artisan queue:retry all
```

---

Con esta estructura puedes trabajar y probar la solución completa solicitada en la prueba de MiCasino tanto en frontend como backend. Asegúrate de que el archivo `.env` esté correctamente configurado y que los workers estén en ejecución para el correcto manejo de colas.

---

## 🌐 Autor

[Pieromental](https://github.com/Pieromental)
