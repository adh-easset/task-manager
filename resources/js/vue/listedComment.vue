<template>
    <div>
        <div v-for="(comment,created_at) in comments" :key="created_at">
            <comment-temp
                :comment="comment"
                class="comment"
            />
        </div>
    </div>
</template>

<script>
import commentTemp from "./commentTemp";
export default {
    props: ['comments'],
    components : {
        commentTemp,
    },
    mounted() {
        this.$root.$on("newOutput", ()=>this.$emit('reloadlist'))
    }
}
</script>

<style scoped>
.comment{
    border-bottom: 1px solid #42454A;
    padding: 2%;
    color: #FFFFED;
    font-family: 'Noto Sans', sans-serif;
    font-weight: 400;
}
</style>
