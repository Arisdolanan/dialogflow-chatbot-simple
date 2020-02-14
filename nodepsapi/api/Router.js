'use strict';

module.exports = function(app) {
  const Controller = require('./Controllers/Controller');

  app.get('/',function(req,res){
    console.log('I am Happy ChatBot');  
    res.send('I am Happy ChatBot');
  });

  // registerUser Route
  app.route('/')
    .post(Controller.processRequest);
};