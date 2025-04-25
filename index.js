const express = require('express');
const app = express();
const PORT = 8080;

app.get('/', (req, res) => {
  res.send('Hello from Gitpod!');
});

app.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
});
