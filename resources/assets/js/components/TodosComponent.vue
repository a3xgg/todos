<template>
  <div class="row">
  <div class="container">
   <div class="row">
     <div class="col-md-6 mx-auto">
 <h1 class="todos-title">Todos</h1>
       <div class="todos-wrapper">
  <ul class="list-group todos-list">

      <li class="list-group-item todos-list-item" v-for="todo in todos"><a href="">{{ todo.title }}</a></li>

   </ul>
        </div>
      </div>
    </div>
  </div>
 </div>

</template>

<script>
export default {
  data: function() {
      return {
        todos:[
          {
            id: 1,
            title: 'test',
          },
          {
            id: 2,
            title: 'test2',
          }
        ]
      };
    },
  mounted() {
      console.log("Hello World");
    }
}
</script>