App.MainPageController = Ember.ObjectController.extend({
  needs: ['application'],
  hasClicked: false,
  email: "",
  inputError: false,
  init: function() {
    this._super();
    var that = this;
    console.log("loaded");
  },
  addEmailSendNewsletter: function(email) {
      return $.ajax({
          url: "Rest/splashController.php",
          type: "POST",
          dataType:'json',
          data: {email: email},
          error: function(data){
            console.log(data);
          }
      });
  },
  actions: { 
    clickToggle: function() {
      var verifyAt = this.get('email').split('@');
      var verifyPer = this.get('email').split('.');
      console.log(this.get('email'));
      if(!this.get('email') || this.get('email') == "" || this.get('email').length < 7 ||verifyAt.length != 2 || verifyPer.length < 2){
        this.set('inputError',true);
      } else{
        this.set('hasClicked',true);
        this.addEmailSendNewsletter(this.get('email'));
      }
      
    }
  }
});