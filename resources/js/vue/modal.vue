<template>
  <div v-if="showModal">
    <div id="modal">


        <slot class="modal-header">
            <h1>Task description</h1>
        </slot>

        <div class="modal-body">
            <slot name="modal-body" v-modal="text"></slot>
        </div>

        <div class="input">
            <textarea id="subject" name="subject" placeholder="Add/Edit Task Description" v-model="newDescription" @change="processChange()"></textarea>
        </div>

        <div class="action-buttons">
            <b-button variant="light sm"  @click="hide">Close</b-button>
            <b-button variant="light sm"  @click="postDescription">Save</b-button>
        </div>

    </div>

  </div>
</template>

<script>
    export default {
        props: ['item'],
        data() {
            return {
                showModal: false,
                text: this.$parent.item.description,
                newDescription: ''
            }
        },
        methods: {
            processChange(){
                this.text = this.newDescription;
            },
            show() {
                this.showModal = true


            },
            hide(){
                this.showModal = false
            },
            postDescription(){
                // console.log(this.newDescription);
                // console.log(this.$parent.item);
                const newDesc = this.newDescription;
                const newComplete = this.$parent.item.completed;

            axios.put('api/item/' + this.$parent.item.id, {
                item: {
                    "completed": newComplete,
                    "description": newDesc
                }
            }).then(res => {
                if(res.status == 200){
                    this.newDescription = '';
                    this.showModal = false;
                    this.$root.$emit('newOutput', newDesc)
                }
            })
            }
        }
    }
</script>

<style>
#modal {
  position:absolute;
  border-radius: 10px;
  right: 35%;
  left: 35%;
  top: 15%;
  bottom: 35%;
  padding: 0;
  margin: auto;
  width: 30%;
  min-width: 300px;
  height: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: grey;
  color:white;
  flex-direction: column;
    overflow: auto; /* Enable scroll if needed */
  background-color: #42BE86; /* Fallback color */
  background-color: rgba(66,190,134,0.9); /* Black w/ opacity */
}
.action-buttons{
    margin: 5% 0;
}
textarea{
    margin-top: 0px;
    margin-bottom: 0px;
    height: 10rem;
    width: 15rem;
    outline: none;
    border: 1px solid #cdcdcd;
    border-color: rgba(0,0,0,.15);
    border-radius: 3px;
    box-shadow: 0 0 2px 1px #306F52;
}
h1{
    border-bottom: solid 1px #E6E6E6;
    width: 90%;
    padding: 3% 0;
    text-align: center;
}
.modal-body{
    font-size: 1.3rem;
}
</style>
