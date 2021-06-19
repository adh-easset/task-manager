<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Task Manager</h2>
            <add-item-form v-on:reloadlist="getList()" />
        </div>
        <list-view
        :items="items"
        v-on:reloadlist="getList()"
        />
    </div>
</template>

<script>
import addItemForm from './addItemForm'
import listView from './listView'
export default {
    components: {
        addItemForm,
        listView
    },
    data: function(){
        return {
            items: [],
        }
    },
    methods: {
        getList () {
            axios.get('api/items')
            .then(res => {
                this.items = res.data;
            })
            .catch( error => {
                console.log(error);
            })
        },
    },
    created(){
        this.getList();
    }
}
</script>

<style scoped>
.todoListContainer{
    max-width: 600px;
    margin: auto;
    margin-top: 5%;
}
.heading{
    background: #e6e6e6;
    padding: 10px;
}
#title{
    text-align:center;
}
</style>
