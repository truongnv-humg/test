<template>
    <div>
        <div class="form-group">
            <input v-model="title" v-on:keyup="updateState('title')" type="text" class="form-control" placeholder="Tiêu đề...">
        </div>
        <div class="form-group">
            <textarea v-model="desc" v-on:keyup="updateState('desc')" class="form-control" name="" cols="30" rows="3" placeholder="Mô tả ngắn..."></textarea>
        </div>
        <div class="form-group">
            <textarea v-model="content" v-on:keyup="updateState('content')" name="" cols="30" rows="10" placeholder="Nội dung..." class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">{{ lang.add.browser }}</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: this.$store.state.post.title,
                desc: this.$store.state.post.desc,
                content: this.$store.state.post.content,

                lang: this.$store.state.post.lang
            }
        },

        methods: {
            updateState: function (state) {
                let _this = this;
                _this.$store.state.post[state] = _this.$data[state]
            }
        },


    }
</script>