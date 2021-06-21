<template>
  <div v-if="showModal">
    <div id="modal">


    <!--Tab start-->

        <b-tabs content-class="mt-0 tabs" fill>

    <!--Task description tab within modal-->
            <b-tab title="Task description">
                <div class="modal-body">
                    <slot name="modal-body" v-modal="text"></slot>
                </div>
                <div class="input">
                    <textarea id="subject" name="subject" placeholder="Add/Edit Task Description" v-model="newDescription" @change="processChange()"></textarea>
                </div>
            </b-tab>

    <!--Comments tab within modal-->
            <b-tab title="Comments">
                <!--comment input field-->
                <div class="addComment">
                <input type="text" class="inputComment" v-model="comment.content"/>
                <font-awesome-icon
                icon="edit"
                @click="addComment(); getComments()"
                />
                </div>

                <!--comment display field-->

                <div class="sc">
                    <listed-comment
                        :comments="comments"
                    />
                </div>

            </b-tab>
        </b-tabs>

    <!--Tab end-->

    <!--save/close buttons within modal-->
        <div class="action-buttons">
            <b-button variant="sm" class="m_button" @click="hide">Close</b-button>
            <b-button variant="sm" class="m_button" @click="postDescription">Save</b-button>
        </div>

    </div>

  </div>
</template>

<script>
    import listedComment from "./listedComment";
    import Vue from 'vue'
    import { eventBus } from '../app'
    export default {
        components: {
            listedComment
        },
        data() {
            return {
                showModal: false,
                text: this.$parent.item.description,
                item_id: this.$parent.item.id,
                newDescription: '',
                comment: {
                    content: ''
                },
                comments: [],
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
            },
            addComment(){
                console.log(this.comment)
                if(this.comment.name == ''){
                    return;
                }

                const newContent = this.comment.content;
                const item_id = this.$parent.item.id;

                // console.log(`Message content :::::: ${newContent}`)
                // console.log(`Task Id :::::: ${item_id}`)

                axios.post('api/comment/store', {
                    Comment: {
                        "content": newContent,
                        "item_id": item_id
                    }
                }).then(res => {
                    if(res.status == 201){
                        this.comment.content = "";
                        this.$root.$emit('reloadList');
                    }
                })
            },
            getComments(){
                axios.get('api/comment/' + this.$parent.item.id)
                    .then(res => {
                        this.comments = res.data
                    }).catch( error => {
                        console.log(error);
                    })
            }
        },
        created(){
            this.getComments();
            eventBus.$on('load_comment', () => this.getComments());
        }
    }
</script>

<style>
#modal {
  position:absolute;
  border-radius: 10px;
  right: 35%;
  left: 35%;
  bottom: 35%;
  padding: 0;
  margin: auto;
  width: 25%;
  min-width: 300px;
  height: 50%;
  display: flex;
  align-items: center;
  background: grey;
  color:white;
  flex-direction: column;
    overflow: auto; /* Enable scroll if needed */
  background-color: #36393F;
}
.action-buttons{
    margin: 5% 0;
    display: block;
    position: relative;
    bottom: 2%;
}
.m_button{
    background-color: #0D6EFD !important;
    color: white !important;
}
textarea{
    height: 5rem;
    width: 100%;
    outline: none;
    border: 1px solid #cdcdcd;
    border-color: rgba(0,0,0,.15);
    border-radius: 3px;
    box-shadow: 0 0 2px 1px #0D6EFD;
}
.input{
    position: absolute;
    bottom: 20%;
    width: 80%;
}
h1{
    border-bottom: solid 1px #E6E6E6;
    width: 90%;
    padding: 3% 0;
    text-align: center;
}
#__BVID__14{
    height: 100%;
}
.modal-body{
    font-size: 1.5rem;
    color: #e6e6e6
}
.tabs{
    padding: 1rem;
    min-width: 100%;
    font-family: 'Roboto', sans-serif;
    color: #00AFF4;
    height: 100%;
}
.addComment{
    width: 100%;
}
.inputComment{
    width: 90%;
}
input{
    font-weight: 100;
}
.sc{
    overflow: hidden;
    overflow-y:scroll;
    max-height: 18rem;
    margin-top: 1%;
}

/* width */
::-webkit-scrollbar {
    width: 8px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #2E3338;
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #202225;
    border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
