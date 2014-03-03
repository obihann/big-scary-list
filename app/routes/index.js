var http, router;

http = require('http');

router = function(app) {
  var user;
  user = require('../controllers/user')(app);
  app.get('/', user.ideas);
  app.get('/idea', user.idea);
  app.get('/new-idea', user.newIdeaPage);
  app.get('/idea/start/:id', user.start);
  app.post('/idea/new', user["new"]);
  app.post('/idea/delete/:id', user["delete"]);
  app.post('/idea/update/:id', user.update);
  return app.post('/idea/finish/:id', user.finish);
};

module.exports = router;
