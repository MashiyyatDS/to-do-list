class Todo {
	constructor(id, isCompleted, todo, user_id) {
		this.id = id;
		this.todo = todo;
		if (isCompleted == true) {
			this.isCompleted = 'completed';
		}else {
			this.isCompleted = '';
		}
	}

	TodoItem() {
		return `
			<li class="collection-item" id="todo-${this.id}">
      	<div id="todo-data-${this.id}">
      	  <b class='todo-txt ${this.isCompleted}'><i class="fa fa-chevron-right"></i> ${this.todo}</b>
      		<div class="secondary-content">
      			<a href="#" onclick="editTodo('${this.id}')"><i class="fa fa-pencil blue-text"></i></a>
      			<a href="#" onclick="markTodo('${this.id}')"><i class="fa fa-check green-text"></i></a>
      			<a href="#" onclick="deleteTodo('${this.id}')"><i class="fa fa-times red-text"></i></a>
      		</div>
      	</div>
      </li>
		`;
	}

	TodoContent() {
		return `
			<div id="todo-data-${this.id}">
    	  <b class='todo-txt ${this.isCompleted}'><i class="fa fa-chevron-right"></i> ${this.todo}</b>
    		<div class="secondary-content">
    			<a href="#" onclick="editTodo('${this.id}')"><i class="fa fa-pencil blue-text"></i></a>
    			<a href="#" onclick="markTodo('${this.id}')"><i class="fa fa-check green-text"></i></a>
    			<a href="#" onclick="deleteTodo('${this.id}')"><i class="fa fa-times red-text"></i></a>
    		</div>
    	</div>
		`;
	}
}

let pageNumber = 1;
$(document).ready(function() {
	swal("Please wait...",{
    buttons:false,
    closeOnClickOutside:false,
    icon:"info"
  });
	$.ajax({
		type:'get',
		url:`${url}/todo/json?page=${pageNumber}`
	}).done(res => {
		swal.close()
		pageNumber = pageNumber + 1;
		console.log(res)
		for(var x in res.todos.data){
			let todo1 = new Todo(
				res.todos.data[x].id, 
				res.todos.data[x].isCompleted, 
				res.todos.data[x].todo, 
				res.todos.data[x].user_id)
			$('#todo-items-container').append(todo1.TodoItem())
		}
	}).fail(err => {
		console.log(err)
	})/*================= GET TODO REQUEST=================*/

	$('.btn-view-more').on('click', function() {
		swal("Please wait...",{
	    buttons:false,
	    closeOnClickOutside:false,
	    icon:"info"
	  });
		$.ajax({
			type:'get',
			url:`${url}/todo/json?page=${pageNumber}`
		}).done(res => {
			if (res.todos.data.length == 0) {
				Materialize.toast("All todos are loaded",2000);
				$('.view-more').remove();
			}
			swal.close()
		  pageNumber = pageNumber + 1;
			console.log(res)
			for(var x in res.todos.data){
				let todo1 = new Todo(
					res.todos.data[x].id, 
					res.todos.data[x].isCompleted, 
					res.todos.data[x].todo, 
					res.todos.data[x].user_id)
				$('#todo-items-container').append(todo1.TodoItem())
			}
		}).fail(err => {
			console.log(err)
		})
	})/*================= VIEW MORE TODO REQUEST=================*/
})

function editTodo(id) {
	swal("Please wait...",{
    buttons:false,
    closeOnClickOutside:false,
    icon:"info"
  });
	$.ajax({
		type:'get',
		url:`${url}/todo/find/${id}`
	}).done(res => {
		console.log(res);
		swal({
			content: {
				element:"input",
				attributes: {
					placeholder: "Edit new todo",
					type: "text",
					value: res.todo.todo
				}
			}
		}).then((value) => {
			if (value) {
				swal("Updating...",{
			    buttons:false,
			    closeOnClickOutside:false,
			    icon:"info"
			  });
				$.ajax({
					type:'post',
					url:`${url}/todo/update/${id}`,
					data: {
						todo:value,
						_token:$('input[name=_token]').val()
					}
				}).done(res => {
					swal.close()
					Materialize.toast("Todo Updated",3000,'blue lighten-1');
					let todo1 = new Todo(res.todo.id,res.todo.isCompleted,res.todo.todo,res.todo.user_id);
					$(`#todo-data-${res.todo.id}`).remove();
					$(`#todo-${res.todo.id}`).append(todo1.TodoContent());
					console.log(res)
				}).fail(err => {
					console.log(err)
				})/*============= TODO EDIT REQUEST ==============*/
			}/*============= IF TODO FORM HAS VALUE ==============*/
		})
	}).fail(err => {
		console.log(err)
	})/* ============== FIND TODO REQUEST ===============*/
}

function addTodo() {
	swal({
		content: {
			element:"input",
			attributes: {
				placeholder: "Add new todo",
				type: "text"
			}
		}
	}).then((value) => {
		if (value) {
			swal("Adding todo...",{
		    buttons:false,
		    closeOnClickOutside:false,
		    icon:"info"
		  });
			$.ajax({
				type:'post',
				url:`${url}/todo/create`,
				data: {
					todo: value,
					_token:$('input[name=_token]').val()
				}
			}).done(res => {
				swal.close()
				Materialize.toast("Todo Created",3000,'blue lighten-1');
				console.log(res)
				let todo1 = new Todo(res.todo.id,res.todo.isCompleted,res.todo.todo,res.todo.user_id);
				$('#todo-items-container').prepend(todo1.TodoItem());
			}).fail(err => {
				console.log(err)
			});
		}
	})
}

function deleteTodo(id) {
	swal({
    title: "Delete selected todo?",
    icon: "info",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
  	if(willDelete) {
	  	$.ajax({
				type:'delete',
				url:`${url}/todo/delete/${id}`,
				data: {
					_token:$('input[name=_token]').val()
				}
			}).done(() => {
				$(`#todo-${id}`).remove();
				Materialize.toast("Succesfully removed",3000);
			}).fail(err => {
				console.log(err)
			})	
  	}
  })/* ============== IF TODO WILLBE DELETED ============= */
	
}

function markTodo(id) {
	$.ajax({
		type:'post',
		url:`${url}/todo/mark-complete/${id}`,
		data: {
			_token:$('input[name=_token]').val()
		}
	}).done(res => {
		console.log(res);
		Materialize.toast("Todo marked as Completed",3000);
		$(`#todo-${id} b`).addClass('completed');
	}).fail(err => {
		console.log(err);
	})
}