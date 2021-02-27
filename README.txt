Benötigte Programme:

- composer (https://getcomposer.org/doc/00-intro.md)
- Node JS (https://nodejs.org/en/download/)
- Laravel (https://laravel.com/docs/8.x)
- Datenbank, in unserem Fall XAMPP mit Apache und MySQL (https://www.apachefriends.org/de/download.html) 
	Info: XAMMP mit php Version 8.0.1 sorgte bei uns für Probleme, Version 7.4.14 funktioniert soweit fehlerfrei

Benötigte Dateien:

-Datenbank (browsergamecollection.sql) im Ordner Sonstiges.


Schritt 1: Composer/ Node JS/ Laravel installieren

Um das Projekt zu öffnen müssen diese 3 Pakete installiert werden. Node JS ist über den oben beigefügten Link herunterladbar. Für die Installation von Composer einfach der Getting Started Seite (Link oben) folgen.
Laravel kann dann ganz einfach über composer installiert werden.

Schritt 2: GitHub Repository klonen und öffnen

Das GitHub Projekt in ein gewünschtes Verzeichnis klonen und mit dem Terminal dieses öffnen.

Schritt 3: Datenbank anlegen und vorbereiten
Als nächstes muss die vorbereitete Datenbank angelegt werden. Dazu die sql-Datei (browsergamecollection.sql) in die Datenbank (in unserem Fall phpMyAdmin von XAMMP) importieren.

Schritt 4: Composer und NPM Dependencies installieren

Via 'composer install', 'npm install' und 'npm run dev' im Projektverzeichnis alle zugehörigen und benötigten Pakete installieren.
Vermutlich muss eine Komponente manuell installiert werden. Dazu den angezeigten Behfehl eingeben und anschließend 'npm run dev' erneut ausführen.

Schritt 5: .env Datei kopieren

Via 'cp .env.example .env' die .env Datei erzeugen, in welcher die wichtigsten Einstellungen der Webseite enthalten sind. außerdem muss via 'php artisan key:generate' ein Zugangsschlüssel generiert werden.

Schritt 6: .env Datei überprüfen

Überprüfen, ob die Einstellungen übernommen wurde (siehe Env-Vorlage in Ordner Sonstiges)

Schritt 7: Storage Link erstellen

Über den Befehl 'php artisan storage:link' eine Verknüpfung zwischen dem Storage Ordner und dem Public Ordner erstellen, damit die Profilbilder und Game Thumbnails angezeigt werden können.

Schritt 8: Webseite lokal hosten

Via 'php artisan serve' das Projekt lokal hosten. Die seite ist über die angezeigte Adresse erreichbar.


Weitere Informationen: https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/

Hinweis: Wenn bei dem Upload von Profilbildern eine Fehlermeldung kommt liegt dies vermutlich an der verwendeten php-Version. Bei neueren Versionen kann es sein, dass eine bestimmt Extension, welche für die Verabeitung der Bilder
benötigt wird nicht installiert wird. Bei uns hat es geholfen eine ältere php-Version (z.B. V. 7.4.14) zu verwenden oder die Extention (GD Library) nachträglich zu installieren.