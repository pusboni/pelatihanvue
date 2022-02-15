<template>
    <div class="container">
        <h1>To-Do App</h1>
        <form class="form">
            <input v-model="input" />
            <button type="button" @click="addList">Submit</button>
        </form>
        <ul class="list">
            <li v-for="(item,index) in list" :key="item.index">
                {{ item.title }} <span class="delete" @click="deleteList(index)">Hapus</span>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data(){
        return{
            list: [
                { title: "menyapu" }, 
                { title: "cuci piring" }
            ],
            input: ""
        }
    }, 
    methods: {
        addList(){
            let newList = {
                title: this.input
            }
            this.list.push(newList)
            this.input = ""
        },
        deleteList(index){
            this.list.splice(index, 1)
        }
    }
}
</script>