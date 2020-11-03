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

                <button class="btn btn-warning btn-small" v-if="btnType==='edit'" @click="btnType='create'"> cancel </button>
                <button class="btn btn-primary btn-small" v-else @click="editView(todo)"> edit </button>

                <button class="btn btn-danger btn-small" @click="deleteTodo(todo)"> delete </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Create Todo -->
      <form @submit.prevent="createTodo" v-if="btnType==='create'">
        <input class="form-control mt-3" v-model="title">
        <button class="btn btn-primary btn-block mt-3">Create Todo</button>
      </form>

      <!-- Edit Todo -->
      <form @submit.prevent="" v-else>
        <input class="form-control mt-3" :value="todo.title">
        <button class="btn btn-success btn-block mt-3">Edit Todo</button>
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
        btnType:'create',
        todo:{},
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
      if(this.btnType==="edit"){
        this.btnType = 'create';
      }
      axios.delete(`/todos/${todoObj.id}`)
      .then((res)=>{
        console.log(res);
        this.getTodos();
      })
      .catch((err)=>{
        console.log(err);
      });
    },
    editView: function(todoObj){
      this.todo = todoObj;
      this.btnType = 'edit';
      console.log(todo.title);
    }
  }
}
</script>