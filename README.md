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

## Orkiestracja (Kubernetes), Monitoring (Prometheus & Grafana) i Testy Obciążeniowe

Projekt został rozszerzony o warstwę orkiestracji kontenerów w środowisku **Kubernetes (Minikube)**, zaawansowany monitoring metryk oraz testy wydajnościowe. 

### Czego użyto i co to daje?
* **Kubernetes (Minikube):** Odpowiada za uruchamianie aplikacji i bazy danych w odseparowanych podach, zapewniając automatyczne skalowanie (**HPA - Horizontal Pod Autoscaler**).
* **Prometheus & Grafana (Stack przez Helm):** Zapewniają zbieranie metryk systemowych w czasie rzeczywistym oraz ich wizualizację na czytelnych wykresach.
* **Skrypt testujący (`stress.sh`):** Narzędzie generujące sztuczny ruch na serwerze w celu weryfikacji zachowania aplikacji pod obciążeniem oraz reakcji klastra (skalowania podów).


### Instrukcja uruchomienia klastra, bazy i aplikacji

#### 1. Odpalenie klastra
```bash
minikube start
```

#### 2.  Postawienie bazy danych MySQL
```bash
kubectl apply -f kubernetes/mysql.yaml
```
#### 3.  Postawienie aplikacji serwisu telefonów
```bash
kubectl apply -f kubernetes/app.yaml
```
#### 4.  Sprawdzenie stanu podów i serwisów
```bash
kubectl get pods
kubectl get services
```
#### 5.  Uruchomienie aplikacji w przeglądarce
```bash
minikube service moja-aplikacja-service
```

### Konfiguracja monitoringu (Prometheus & Grafana)

#### 1. Instalacja stosu monitoringu przez Helm
```bash
helm repo add prometheus-community [https://prometheus-community.github.io/helm-charts](https://prometheus-community.github.io/helm-charts)
helm repo update
helm install monitoring prometheus-community/kube-prometheus-stack
```

#### 2. Sprawdzenie stanu podów monitoringu
```bash
kubectl get pods -A | grep -E "prometheus|grafana"
```

#### 3. Wystawienie Grafany na zewnątrz
```bash
kubectl port-forward svc/monitoring-grafana 3000:80
```

#### 4. Pobranie hasła i logowanie
```bash
kubectl get secret monitoring-grafana -o jsonpath="{.data.admin-password}" | base64 --decode ; echo
```
* Otwórz w przeglądarce: http://localhost:3000
* **Login:** `admin`
* **Hasło:** (ciąg znaków zwrócony przez powyższe polecenie)

### Dashboard i Metryki (PromQL)

W Grafanie przejdź do sekcji Dashboards i wybierz widok zasobów:

`Kubernetes / Compute Resources / Pod`

Wykorzystane zapytania PromQL do monitorowania aplikacji:

* Zużycie CPU dla aplikacji:
```bash
sum(rate(container_cpu_usage_seconds_total{pod=~"moja-aplikacja-.*"}[5m])) by (pod)
```

* Zużycie pamięci RAM:
```bash
container_memory_working_set_bytes{pod="moja-aplikacja-69684466f-7968t"}
```

* Liczba aktywnych podów:
```bash
sum(kube_pod_info{pod=~"moja-aplikacja-.*"})
```

### Skalowanie automatyczne (HPA) i Testy Obciążeniowe
Konfiguracja automatycznego skalowania w zależności od użycia CPU (od 1 do 3 podów):
```bash
kubectl autoscale deployment moja-aplikacja --cpu-percent=50 --min=1 --max=3
```

Przeprowadzenie testu:
Uruchom skrypt obciążający `stress.sh` znajdujący się w katalogu projektu, aby wygenerować ruch:

```bash
./stress.sh
```
Podczas działania skryptu obserwuj w Grafanie wzrost zużycia zasobów oraz dynamiczne dostosowywanie się liczby podów do obciążenia.

<img width="1570" height="470" alt="2" src="https://github.com/user-attachments/assets/e9f01406-dc10-48ff-8576-bfc356263ea3" />

<img width="1571" height="462" alt="3" src="https://github.com/user-attachments/assets/39df29d1-c913-4b86-966c-4b742e2d70ab" />

<img width="1570" height="378" alt="4" src="https://github.com/user-attachments/assets/0bc9b76a-7802-42d9-a711-478014a645cb" />









