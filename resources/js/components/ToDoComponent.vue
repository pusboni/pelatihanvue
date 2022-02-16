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
            item.title
          }}</label>
          <span class="edit" @click="editList(index, item.title)">Edit</span>
          <span class="delete" @click="deleteList(index)">Hapus</span>
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
        { status: false, title: "menyapu" },
        { status: false, title: "cuci piring" },
      ],
      input: null,
      edit: null,
      input_edit: null
    };
  },
  methods: {
    addList() {
      let newList = {
        status: false,
        title: this.input,
      };
      this.list.push(newList);
      this.input = null;
    },
    deleteList(index) {
      this.list.splice(index, 1);
    },
    sortASC() {
      this.list.sort((a, b) => a.title.localeCompare(b.title));
    },
    sortDESC() {
      this.list.sort((a, b) => b.title.localeCompare(a.title));
    },
    editList(index, title){
        this.edit = index
        this.input_edit = title
    }, 
    cancelEdit(){
        this.edit = null
        this.input_edit = null
    },
    confirmEdit(){
       this.list[this.edit].title = this.input_edit
       this.cancelEdit()
    }
  },
};
</script>


























