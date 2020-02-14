const express = require("express");
const bodyParser   = require('body-parser');

//use mysql database
// const mysql = require("mysql");

const PORT = process.env.PORT || 5000;
const app = express();

var routes = require('./api/Router'); //importing route

// import env variables
require("dotenv").config();

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.get("/", (req, res) => {
  res.status(200).send("Server is working.");
});  

routes(app); //register the route

app.listen(PORT, function () {
  console.log(`Express server listening on port ${PORT}`)
})