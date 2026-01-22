import requests
import time
import logging
import random

# -----------------------
# Configuration
# -----------------------
API_URL = "http://127.0.0.1:8000/api/prices"
SOURCE = "python_mock"
INTERVAL_SECONDS = 5

# Supported symbols with base prices
SYMBOLS = {
    "BTCUSDT": 42000,
    "EURUSD": 1.0850
}

# -----------------------
# Logging
# -----------------------
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s | %(levelname)s | %(message)s"
)

# -----------------------
# Mock price generator
# -----------------------
def get_mock_price(symbol: str) -> float:
    base_price = SYMBOLS[symbol]

    if symbol == "BTCUSDT":
        fluctuation = random.uniform(-100, 100)
        return round(base_price + fluctuation, 2)

    if symbol == "EURUSD":
        fluctuation = random.uniform(-0.002, 0.002)
        return round(base_price + fluctuation, 5)

    return base_price

# -----------------------
# Push price to Laravel
# -----------------------
def push_price(symbol: str, price: float) -> None:
    payload = {
        "symbol": symbol,
        "price": price,
        "source": SOURCE
    }

    response = requests.post(API_URL, json=payload, timeout=5)
    response.raise_for_status()

# -----------------------
# Main loop
# -----------------------
def main():
    logging.info("Starting multi-symbol price fetcher...")

    while True:
        for symbol in SYMBOLS.keys():
            try:
                price = get_mock_price(symbol)
                logging.info(f"{symbol} price: {price}")

                push_price(symbol, price)
                logging.info(f"{symbol} pushed successfully")

            except requests.exceptions.RequestException as e:
                logging.error(f"{symbol} HTTP error: {e}")

            except Exception as e:
                logging.error(f"{symbol} unexpected error: {e}")

        time.sleep(INTERVAL_SECONDS)

if __name__ == "__main__":
    main()
