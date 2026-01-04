const express = require('express');
const app = express();
const PORT = 3000;
const HOST = '0.0.0.0'; // ESSENCIAL: Escuta em todos os IPs disponíveis

app.get('/', (req, res) => {
  res.send('Node.js App está rodando!');
});

app.listen(PORT, HOST, () => {
  console.log(`Servidor rodando internamente em http://${HOST}:${PORT}`);
});