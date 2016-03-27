Vue.component('modal', {
  template: '#modal-template',
  props: {
    show: {
      type: Boolean,
      required: true,
      twoWay: true    
    }, 
    newpage: {
      type: String,
      required: true,
      twoWay: true    
    }
  },
  methods: {
    entered: function(title)
    {
      this.$dispatch('modal-msg', title);
      this.show=false;
    }
  }
})


window.addEventListener('load', function () {
    // register modal component


    new Vue({
  el: '#app',
  data: {
  	messages:[],
  	submitted: false,
  	newMessage: {
  		title: '',
  		parent_id: ''
  	},
    edited: -1,
    showModal: false,
    test: "enter page name",

  },
 
  computed: {
  	errorsa: function() {
  		for (var key in this.newMessage) {
  			if (! this.newMessage[key]) return true;
  		}

  		return false;
  	}
  },
  
  ready: function(){
  	this.fetchMessages();
  },

  events: {
    'modal-msg': function(msg){
    if (this.edited!=-1){
      this.messages[this.edited].title=msg;
    } else {
    this.messages.push({title: msg, parent_id: '0'});
  }
     

    }
  },

  methods: {
  	fetchMessages: function () {
  		this.$http.get('/admin/adminget').then(function(response)
  	{
  		this.$set('messages', response.data);
  	});

  	},
    onClickAddPage: function(){
      var currentindx = this.messages.length;
      this.messages.push({ title: 'New page', parent_id: '0'});
      this.test=this.messages[currentindx].title;
      this.edited = currentindx;

      this.showModal = true;

    },

  	onSubmitForm: function () {
  	var postmessage = this.newMessage;

  	this.messages.push(postmessage);
  	this.newMessage = { title: '', parent_id: ''};
  	//this.$http.post('/send', postmessage);



  	//this.submitted = true;
  	},

    clicked: function (indx) {
    this.edited = indx;  
    this.test= this.messages[indx].title;
    this.showModal=true;
    },

    removes: function(indx){
      var removemess = this.messages[indx];

    this.messages.$remove(removemess);  

    },  

     entered: function (info) {
      this.showModal=false;
    this.item.title = info;
    }


  }
});
})

