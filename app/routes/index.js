var http, router;

http = require('http');

router = function(app) {
  var user;
  user = require('../controllers/user')(app);
  app.get('/', user.index);
  app.get('/ideas/:id', user.ideas);
  app.get('/new-idea', user.newIdeaPage);
  app.get('/idea/start/:id', user.start);
  app.post('/idea/new', user["new"]);
  app.post('/idea/delete/:id', user["delete"]);
  app.post('/idea/update/:id', user.update);
  app.post('/idea/finish/:id', user.finish);
  app.get('/login', user.loginPage);
  app.post('/register', user.register);
  return app.post('/login', user.login);
};

module.exports = router;
