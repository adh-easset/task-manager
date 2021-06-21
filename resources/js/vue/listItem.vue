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
        <b-button :class="[item.description ? 'Description' : 'empty-description']" @click="openModal ">
            <font-awesome-icon icon="comment-alt" />
        </b-button>
        <button @click="removeItem()" class="trashcan">
            <font-awesome-icon icon="window-close" />
        </button>

        <modal ref="modal">
            <template v-slot:modal-body>
                <p> {{ output }} </p>
            </template>
        </modal>
    </div>
</template>

<script>
import modal from './modal'
import Vue from 'vue'
import { eventBus } from '../app'
export default {
    props: ['item'],
    components: { modal },
    data() {
        return{
            output: "This is a description",
        }
    },
    methods: {
        updateCheck(){
            axios.put('api/item/' + this.item.id, {
                item: this.item
            })
            .then(responce =>{
                // console.log(`step one: ${item}`)
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
        openModal() {
            this.$refs.modal.show()
            const item_id = this.item.id;
                // console.log(`this items id ::: ${item_id}`)
            this.$nextTick(function () {
                    // console.log(`1:  %%%    ${this.item.description}`)
                this.output = this.item.description
                    // console.log(`3:  ***    ${this.output}`)
            })
            eventBus.$emit('load_comment')
        },
    },

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
.empty-description{
    background: none;
    outline: none;
    border: none;
    color: #999999;
}
.Description{
    background: none;
    outline: none;
    border: none;
    color: #5DB0D7;
}
</style>
