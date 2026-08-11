#  System Zarządzania Serwisem Telefonów

![CI Pipeline](https://github.com/karol-grabowski/serwis-telefonow-docker/actions/workflows/ci-cd.yml/badge.svg)

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

##  CI Pipeline & DevOps

W projekcie skonfigurowano pipeline **Continuous Integration (CI)** oparty o **GitHub Actions** (`build-and-push`), który automatycznie weryfikuje kod oraz obraz przy każdym wdrożeniu:

###  Przepływ pracy (Pipeline Workflow):
1. **PHP Syntax Check (Lint):** Automatyczna weryfikacja poprawności składniowej kodu PHP przed budowaniem.
2. **Multi-stage Docker Build:** Konfiguracja `Docker Buildx` do szybkiego i zoptymalizowanego budowania obrazu aplikacji.
3. **Security Vulnerability Scanning (Trivy):** Automatyczne skanowanie obrazu kontenera pod kątem podatności i luk bezpieczeństwa przed jego publikacją.
4. **Automated Docker Registry Push:** Bezpieczne wysyłanie przetestowanego i przeskanowanego obrazu do **Docker Hub**.


## Instrukcja Uruchomienia (Krok po Kroku)

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

---
### Wygląd interfejsu
<img width="1896" height="896" alt="design" src="https://github.com/user-attachments/assets/ef0b61ca-5bd9-44e3-b63e-668e8286bf0b" />


