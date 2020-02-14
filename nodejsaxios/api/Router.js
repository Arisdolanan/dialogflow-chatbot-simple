'use strict';

module.exports = function(app) {
  var Controller = require('./Controllers/Controller');
  // registerUser Route
  app.route('/')
    .post(Controller.processRequest);
};