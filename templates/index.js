module.exports = {
  resource: {
    template: 'resource.ejs',
    filename: function(resource, helpers) {
      return helpers.cap(helpers.plural(resource.name)) + 'Base.php';
    }
  }
};
