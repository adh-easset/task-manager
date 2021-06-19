<template>
    <div class="comment">
            <div class="ib date">
            {{comment.created_at}}
        </div>
        <div class="ib content">
            {{ comment.content }}
        </div>
    </div>
</template>

<script>
export default {
    props: ['comment'],
}
</script>

<style  scoped>
.ib{

}
.date{
    text-align: right;
    font-size: 50%;
    padding-bottom: 2%;
}
.comment{
    width: 100%
}

</style>
