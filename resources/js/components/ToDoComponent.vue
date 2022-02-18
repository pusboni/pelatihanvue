<template>
  <div class="container">
    <h1>To-Do App</h1>
    <form class="form">
      <input v-model="input" />
      <button type="button" @click="addList">Submit</button>
    </form>
    <br />
    <button type="button" @click="sortASC">A-Z</button>
    <button type="button" @click="sortDESC">Z-A</button>
    <br />
    <ul class="list">
      <li v-for="(item, index) in list" :key="index">
        <template v-if="index != edit">
          <input type="checkbox" :id="list + index" v-model="item.status" />
          <label :for="list + index" :class="item.status ? 'done' : ''">{{
            item.description
          }}</label>
          <span class="edit" @click="editList(index, item.description)">Edit</span>
          <span class="delete" @click="deleteList(index, item.id)">Hapus</span>
        </template>
        <template v-if="index == edit">
          <form class="form">
            <input v-model="input_edit" name="edit_todo" />
            <button type="button" @click="confirmEdit">Change</button>
            <button type="button" @click="cancelEdit">Cancel</button>
          </form>
        </template>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: [
        { status: false, description: "menyapu" },
        { status: false, description: "cuci piring" },
      ],
      input: null,
      edit: null,
      input_edit: null
    };
  },
  mounted(){
    let url = '/api/get_todo_list'
    axios.get(url).then(response => {
      console.log(response);
      this.list = response.data
    })
  },
  methods: {
    addList() {
      let newList = {
        status: false,
        description: this.input,
      }
      let url = '/api/add_todo'
      axios.post(url, newList).then((response) => {
        console.log(response.data)
        this.list.push(response.data)
        this.input = null;
      })
    },
    deleteList(index, id) {
      let url = '/api/delete_todo/' + id
      axios.get(url).then((response) => {
        this.list.splice(index, 1);
      })
    },
    sortASC() {
      this.list.sort((a, b) => a.description.localeCompare(b.description));
    },
    sortDESC() {
      this.list.sort((a, b) => b.description.localeCompare(a.description));
    },
    editList(index, description){
        this.edit = index
        this.input_edit = description
    }, 
    cancelEdit(){
        this.edit = null
        this.input_edit = null
    },
    confirmEdit(){
       this.list[this.edit].description = this.input_edit
       this.cancelEdit()
    }
  },
};
</script>


























