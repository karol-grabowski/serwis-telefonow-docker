#  System Zarządzania Serwisem GSM

Aplikacja webowa do obsługi serwisu telefonów, magazynu oraz punktu skupu i sprzedaży urządzeń.


##  Co oferuje system?

*  Zlecenia i urządzenia: Rejestracja napraw, wyliczanie kosztów i szybka wyszukiwarka przedmiotów.
*  Magazyn części: Rejestracja, modyfikacja, usuwanie, przegląd części zamiennych.
*  Finanse: Moduł rozliczeń i podsumowań płatności za naprawy.
* Uprawnienia:
  * **Admin:** Pełny dostęp, finanse i tworzenie kont pracowników.
  * **Pracownik:** Obsługa klientów, edycja zleceń i magazynu.


##  Stack Technologiczny

* **Aplikacja:** PHP 8.1, HTML5, CSS3
* **Baza danych:** MySQL 8.0
* **Infrastruktura:** Docker & Docker Compose

---

## 🚀 Instrukcja Uruchomienia (Krok po Kroku)

### Krok 1: Pobranie projektu

Pobierz pliki z repozytorium do dowolnego folderu na swoim systemie (np. na Linuksie / Ubuntu):

```bash
git clone https://github.com/karol-grabowski/serwis-telefonow-docker.git .
```

### Krok 2: Uruchomienie w Dockerze
Będąc w tym samym folderze, uruchom środowisko w tle:

```bash
docker compose up -d
```
### Krok 3: Dostęp do aplikacji
Otwórz przeglądarkę i wejdź pod adres:

👉 http://localhost:8080/strona.php
