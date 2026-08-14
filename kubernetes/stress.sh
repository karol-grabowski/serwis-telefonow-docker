#!/bin/bash

NODE_IP=$(minikube ip)
NODE_PORT=32026
URL="http://${NODE_IP}:${NODE_PORT}"

echo "=================================================="
echo "          GENERATOR OBCIĄŻENIA K8S                "
echo "=================================================="
echo "Cel: $URL"
echo ""

read -p "Ile zapytań w JEDNEJ paczce (np. 10, 20, 50)? " BATCH_SIZE
read -p "Co ile sekund wysyłać paczkę (np. 1 dla 1s, 0.1 dla 100ms)? " DELAY
read -p "Jaka ścieżka (np. /klienci.php lub /wyszukaj.php)? " ENDPOINT

FULL_URL="${URL}${ENDPOINT}"

echo ""
echo "Odpalam ostrzał na: $FULL_URL"
echo "Paczka: $BATCH_SIZE zapytań | Przerwa: ${DELAY}s"
echo "Naciśnij [CTRL+C], aby zatrzymać."
echo "=================================================="

COUNTER=0

while true; do
    for (( i=1; i<=BATCH_SIZE; i++ )); do
        curl -s -o /dev/null "$FULL_URL" &
    done
    wait
    COUNTER=$((COUNTER + BATCH_SIZE))
    echo "[$(date +'%H:%M:%S')] Poszło łącznie: $COUNTER zapytań"
    sleep $DELAY
done
