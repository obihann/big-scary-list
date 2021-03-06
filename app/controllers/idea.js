var Users, config, ideaController, _;

config = require('../config');

_ = require('underscore');

Users = require('../models/user');

ideaController = function(app) {
  return {
    ideas: function(req, res) {
      var user_id;
      user_id = '5310aa29df63c208a6000001';
      return Users.findOne({
        _id: user_id
      }).exec(function(err, user) {
        return res.render('ideas', {
          layout: 'layout',
          ideas: user.ideas
        });
      });
    },
    newIdeaPage: function(req, res) {
      return res.render('ideas-new', {
        layout: 'layout'
      });
    },
    idea: function(req, res) {},
    "new": function(req, res) {
      var data, user_id;
      data = req.body;
      user_id = '5310aa29df63c208a6000001';
      return Users.findOne({
        _id: user_id
      }).exec(function(err, user) {
        var idea;
        if (err) {
          console.log(err);
        }
        idea = {
          name: data.idea,
          description: data.description,
          user: user
        };
        user.ideas.push(idea);
        return user.save(function(err) {
          if (err) {
            console.log(err);
          }
          return res.redirect('/');
        });
      });
    },
    "delete": function(req, res) {},
    update: function(req, res) {},
    start: function(req, res) {},
    finish: function(req, res) {}
  };
};

module.exports = ideaController;
