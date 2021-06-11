<template>
    <div class="item">
        <input
        type="checkbox"
        @change="updateCheck()"
        v-model="item.completed"
        />
        <span :class="[item.completed ? 'completed' : '','itemText']">
            {{ item.name }}
        </span>
        <b-button class="Description" @click="descOpen()">
            <font-awesome-icon icon="comment-alt" />
        </b-button>
        <button @click="removeItem()" class="trashcan">
            <font-awesome-icon icon="window-close" />
        </button>
    </div>
</template>

<script>
export default {
    props: ['item'],
    methods: {
        updateCheck(){
            axios.put('api/item/' + this.item.id, {
                item: this.item
            })
            .then(responce =>{
                if( responce.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        removeItem() {
            axios.delete('api/item/' + this.item.id)
            .then(responce => {
                if (responce.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch(error => {
                console.log(error)
            })
        },
        descOpen() {
            console.log(this.item)
            this.$emit('openModal')
        }
    }
}
</script>

<style  scoped>
.completed{
    text-decoration: line-through;
    color: #999;
}
.itemText {
    width: 100%;
    margin-left: 20px;
}
.item{
    display:flex;
    justify-content: center;
    align-items: center;
}
.trashcan{
    background: #e6e6e6;
    border:none;
    color: #ff0000;
    outline: none;
}
.Description{
    background: none;
    outline: none;
    border: none;
    color: #5DB0D7;
}
</style>
