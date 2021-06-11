<template>
    <div>
        <div v-for="(item,index) in items" :key="index">
            <list-item
                :item="item"
                class="item"
                v-on:itemchanged="$emit('reloadlist')"
                v-on:openModal="addDescription(item)"
            />
        </div>
    <b-modal id="bv-modal-description" hide-footer>
        <template #modal-title>
            Add a task description
        </template>
        <div class="">

        </div>
        <div class="d-block text-center">
            <input type=text/>
        </div>

        <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-description')">Close Me</b-button>
    </b-modal>

    </div>
</template>

<script>
import listItem from "./listItem";
export default {
    props: ['items'],
    components : {
        listItem
    },
    methods : {
        addDescription(item) {
            console.log(`second step: ${JSON.stringify(item.name)}`);
            this.$bvModal.show('bv-modal-description');

            axios.put
        }
    }
}
</script>

<style scoped>
.item{
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>
