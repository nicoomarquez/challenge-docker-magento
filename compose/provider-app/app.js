const express = require('express');
const db = require('./offers-db');

const app = express();

const hostname = '0.0.0.0';
const port = 3000;

app.get('/getAllSkuOffers/:sku', (req, res) => {
  const { sku } = req.params
  console.log(`Getting all offers of ${sku}`);
  const [offers] = db.filter(offerItem => offerItem.sku === sku);
  console.log(offers)
  res.json(offers ?? {'error': 'Offers not found'})
})

app.listen(port, hostname, () => {
  console.log(`Server running at http://${hostname}:${port}/`);
});

module.exports = app;
