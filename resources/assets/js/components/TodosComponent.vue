<template>
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <h1 class="todos-title">Todo</h1>
          <div class="todos-wrapper">
            <ul class="list-group todos-list">
              <li class="list-group-item todos-list-item" v-for="todo in todos" v-bind:key="todo.id">
                <a class="todos-list-item-link">{{ todo.title }}</a>
                <button class="btn btn-primary btn-small" @click="editTodo(todo)"> edit </button>
                <button class="btn btn-danger btn-small" @click="deleteTodo(todo)"> delete </button>
                <input type="text" v-model="todo.newTitle">
              </li>
            </ul>
          </div>
        </div>
      </div>
      <form @submit.prevent="createTodo">
        <label for="title">New Todo</label>
        <input id="title" class="form-control" v-model="title">
        <button class="btn btn-primary btn-block">Create Todo</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
      return {
        todos:[],
        title:'',
      };
    },
  mounted() {
    this.getTodos();
  },
  methods: {
    getTodos: function(){
      axios.get('/todos').then(({data}) => {
        this.todos = data;
      }, (error) => {console.log(error)});
    },
    createTodo: function(){
      axios.post('/todos', {title: this.title})
      .then((res)=>{
        console.log(res);
        this.title = '';
        this.getTodos();
      })
      .catch((err)=>{
        console.log(err)
      });
    },
    editTodo: function(todoObj){
      axios.put(`/todos/${todoObj.id}`, {title: todoObj.newTitle})
      .then((res)=>{
        console.log(res);
        this.getTodos();
      })
      .catch((err)=>{
        console.log(err);
      });
    },
    deleteTodo: function(todoObj){
      axios.delete(`/todos/${todoObj.id}`)
      .then((res)=>{
        console.log(res);
        this.getTodos();
      })
      .catch((err)=>{
        console.log(err);
      });
    }
  }
}
</script>