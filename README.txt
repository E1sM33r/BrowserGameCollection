Benötigte Programme:

- composer (https://getcomposer.org/doc/00-intro.md)
- Node JS (https://nodejs.org/en/download/)
- Laravel (https://laravel.com/docs/8.x)
- Datenbank (in unserem Fall XAMPP mit Apache und MySQL)

Benötigte Dateien:

-Datenbank (browsergamecollection.sql) im Ordner Sonstiges.



Schritt 1: Composer/ Node JS/ Laravel installieren

Um das Projekt zu öffnen müssen diese 3 Pakete installiert werden. Node JS ist über den oben beigefügten Link herunterladbar. Für die Installation von Composer einfach der Getting Started Seite (Link oben) folgen.
Laravel kann dann ganz einfach über composer installiert werden.

Schritt 2: Datenbank anlegen

Als nächstes muss die vorbereitete Datenbank angelegt werden. Dazu die sql-Datei (browsergamecollection.sql) in die Datenbank (in unserem Fall phpMyAdmin von XAMMP) importieren.

Schritt 3: GitHub Repository klonen und öffnen

Das gitHub Projekt in ein gewünschtes Verzeichnis klonen und mit dem Terminal dieses öffnen.

Schritt 4: Composer und NPM Dependencies installieren

Via 'composer install' und 'npm install' im Projektverzeichnis alle zugehörigen und benötigten Pakete installieren.

Schritt 5: .env Datei kopieren

Via 'cp .env.example .env' die .env Datei erzeugen, in welcher die wichtigsten Einstellungen der Webseite enthalten sind. außerdem muss via 'php artisan key:generate' ein Zugangsschlüssel generiert werden.

Schritt 6: .env Datei überprüfen

Überprüfen, ob die Einstellungen übernommen wurde (siehe Bild in Ordner Sonstiges)

Schritt 7: Webseite lokal hosten

Via 'php artisan serve' das Projekt lokal hosten. Die seite ist über die angezeigte Adresse erreichbar.