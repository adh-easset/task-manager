<template>
    <div>
        <div v-for="(item,index) in items" :key="index">
            <list-item
                :item="item"
                class="item"
                v-on:itemchanged="$emit('reloadlist')"
            />
        </div>
    </div>
</template>

<script>
import listItem from "./listItem";
import modal from "./modal";
export default {
    props: ['items'],
    components : {
        listItem,
    },
    mounted() {
        this.$root.$on("newOutput", ()=>this.$emit('reloadlist'))
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
