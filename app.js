let ws = new WebSocket('wss://stream.binance.com:9443/ws/etheur@trade');
let cryptoPriceElement = document.getElementById('stock-price');
let lastPrice = null;

ws.onmessage = (event) => {
    let cryptoObj = JSON.parse(event.data);
    let price = parseFloat(cryptoObj.p).toFixed(2);
    cryptoPriceElement.innerText = price;

    cryptoPriceElement.style.color = !lastPrice || lastPrice === price ? 'black': price > lastPrice ? 'green': 'red';


    lastPrice = price;
};