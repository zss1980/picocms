@extends('layouts.master')

@section('title')
Admin picoCMS
@stop
@section('body')


<h1>Admin Section</h1>
{!!$page_content !!}
<!-- template for the modal component -->


<h3>Current User menu</h3><hr>
  <div id="app">
 
  <article v-for="item in messages">
      
	         <button style="position:relative; left:0px; display: block;" type="button" class="btn btn-danger btn-xs" id="remove" v-on:click="removes($index)"><span class="glyphicon glyphicon-remove"></span></button></span></button>
	         
	         <button style="position:relative; display: block;"id='menu-@{{$index}}' type="button" class="btn btn-info" id="show-modal" v-on:click="clicked($index)">@{{$index}} @{{item.title}}</button>

	         

	         <button style="position:relative; float: right; display: block;" type="button" class="btn btn-warning btn-xs" id="remove" v-on:click="addsubpage($index)"><span class="glyphicon glyphicon-plus-sign"></span></button></span></button>
         
  </article><span><button style="position:relative; top:2em;" type="button" class="btn btn-default btn-sm" v-on:click="onClickAddPage">
          <span class="glyphicon glyphicon-plus"></span></button></span>
<hr><br><hr>
<modal :show.sync="showModal" :newpage.sync="test">
</modal>


<form method="POST" v-on:submit.prevent="onSubmitForm">
    <div class="form-group">
    <label for="author">Author:
<span class="errorsa" v-if="! newMessage.author">*</span>
    </label>
    <input type="text" name="title" id="title" class="form-control" v-model="newMessage.title">
        
    </div>
    <div class="form-group">
    <label for="message">Message:
    <span class="errorsa" v-if="!newMessage.message">*</span>
    </label>
    <textarea type="text" name="parent_id" id="parent_id" class="form-control" v-model="newMessage.parent_id">
        </textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default" :disabled="errorsa" v-if="! submitted">Send a message</button>
    </div>
    <div class="alert alert-success" v-if="submitted">Thanks!</div>
</form>

  
 
</div>
<!-- template for the modal component -->
<script type="x/template" id="modal-template">

  <div class="modal-mask" v-show="show" transition="modal">
    <div class="modal-wrapper">
      <div class="modal-container">

        <div class="modal-header">
          <slot name="header">
            Name of the page:
          </slot>
        </div>

        <div class="modal-body">
          <slot name="body">
            Name:
            <input v-model="newpage" @keyup.enter="entered(newpage)">
           
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <button class="modal-default-button"
              @click="show = false">
              Cancel
            </button>
            <button class="modal-default-button"
              @click="show = false">
              OK
            </button>
          </slot>
        </div>
      </div>
    </div>
  </div>

</script>

@stop