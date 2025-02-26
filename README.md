# Noleggio Veicoli Elettrici

Un'applicazione web sviluppata con Laravel per la gestione di un servizio di noleggio veicoli elettrici, che consente agli utenti di prenotare veicoli e agli amministratori di gestire l'intero sistema.

## Caratteristiche Principali

- 🚗 **Gestione veicoli elettrici** - Catalogo completo con dettagli tecnici
- 👤 **Sistema di autenticazione** - Registrazione e login utenti
- 📅 **Sistema di prenotazione** - Noleggio veicoli con selezione date e orari
- 💰 **Calcolo tariffe automatico** - Basato su durata del noleggio
- 📊 **Dashboard utente** - Monitoraggio dei noleggi attivi e completati
- 👑 **Pannello amministratore** - Gestione completa di veicoli, utenti e noleggi
- 📱 **Design responsive** - Ottimizzato per tutti i dispositivi

## Tecnologie Utilizzate

- **Laravel 11** - Framework PHP
- **Tailwind CSS** - Framework CSS
- **MySQL** - Database
- **Vite** - Build tool

## Requisiti di Sistema

- PHP >= 8.2
- Composer
- Node.js e NPM
- MySQL o SQLite
- Git

## Installazione

### 1. Clona il repository
```sh
git clone https://github.com/username/noleggio_veicoli_elettrici.git
cd noleggio_veicoli_elettrici
```

### 2. Installare le dipendenze PHP
```sh
composer install
```

### 3. Installa le dipendenze JavaScript
```sh
npm install
```

### 4. Configurare l'ambiente
```sh
cp .env.example .env
php artisan key:generate
```

### 5. Configura il database nel file `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=noleggio_ev
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Esegui le migrazioni e i seeder
```sh
php artisan migrate --seed
```

### 7. Compila gli asset
```sh
npm run dev
```

### 8. Avvia il server locale
Puoi avviare il server in due modi:

**Metodo standard:**
```sh
php artisan serve
```
**Metodo completo (consigliato per lo sviluppo):**
```sh
composer dev
```

Questo comando avvia contemporaneamente:

- Il server Laravel `(php artisan serve)`
- Il worker per le code `(php artisan queue:listen)`
- Il compilatore degli asset frontend `(npm run dev)`

### 9. Accedi all'applicazione

- **URL**: [http://localhost:8000](http://localhost:8000)
- **Admin**: `admin@example.com / password`
- **Utente**: `user@example.com / password`

## Struttura del Progetto

- `app/Models/` - Modelli dell'applicazione (Vehicle, Rental, User)
- `app/Http/Controllers/` - Controller per la logica dell'applicazione
- `resources/views/` - Template Blade per l'interfaccia utente
- `routes/web.php` - Definizione delle rotte web
- `database/migrations/` - Migrazioni del database
- `database/seeders/` - Seeder per popolare il database

## Funzionalità Utente

- Registrazione e login
- Visualizzazione catalogo veicoli
- Prenotazione veicoli con selezione di date e orari
- Visualizzazione dello storico noleggi
- Gestione del profilo

## Funzionalità Admin

- Dashboard amministrativa
- Gestione completa del catalogo veicoli
- Monitoraggio e gestione delle prenotazioni
- Gestione utenti e clienti
- Reportistica

## Screenshots

_(inserire alcuni screenshot dell'applicazione)_

## Contatti

Per supporto o informazioni, contattare:

- **Email**: info@noleggioev.it
- **Telefono**: +39 123 456 7890

## Licenza

Questo progetto è rilasciato sotto licenza MIT. Vedere il file LICENSE per maggiori dettagli.

© 2023-2024 Noleggio EV. Tutti i diritti riservati.
