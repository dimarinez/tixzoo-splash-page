var loaderObj = {
    templates : [
    'tmpl/mainpage.html'
    ],
    css : [
    '../../css/bootstrap.css',
    '../../style.css'
  ]
};


//This function loads all templates into the view
function loadTemplates(templates) {
    $(templates).each(function() {
        var tempObj = $('<script>');
        tempObj.attr('type', 'text/x-handlebars');
        var dataTemplateName = this.substring(0, this.indexOf('.'));
        tempObj.attr('data-template-name', dataTemplateName);
        $.ajax({
            async: false,
            type: 'GET',
            url: 'js/views/' + this,
            success: function(resp) {
                tempObj.html(resp);
                $('body').append(tempObj);
            }
        });
    });

}
//This function loads all css into the html body
function loadCss(css) {
    $(css).each(function() {
        var tempObjCss = $('<style>');

        var dataTemplateNameCss = this.substring(0, this.indexOf('.'));
        $.ajax({
            async: false,
            type: 'GET',
            url: 'js/views/' + this,
            success: function(resp) {
                tempObjCss.html(resp);
                $('body').append(tempObjCss);
            }
        });
    });
}

loadCss(loaderObj.css);
loadTemplates(loaderObj.templates);



App = Ember.Application.create();

App.Router.map(function() {
  this.resource("main-page", function(){
    this.route("load", { path: "/" });
  });
});



App.ApplicationController = Ember.Controller.extend({
  route: 'main-page',
  init: function() {
    this._super();
      this.transitionToRoute(this.get('route'));
  },
    actions: {
    query: function() {
      // the current value of the text field
      var query = this.get('search');
      this.transitionToRoute('search', { query: query });
    }
  }
});

/*
 * ApplicationRoute
 */