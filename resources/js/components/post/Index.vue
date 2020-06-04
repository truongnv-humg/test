<template>
    <div>
        <div class="row">
            <div class="col-8">
                <div class="mb-2">
                    <action></action>
                </div>
                <div class="mb-3">
                    <tab></tab>
                </div>
                <div>
                    <formNormal></formNormal>
                </div>
                <div>
                    <button v-on:click="handleClick()" class="btn btn-success">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import action from "./partials/action";
    import tab from "./partials/tab";
    import formNormal from "./partials/form_normal";
    import formAdvance from "./partials/form_advance";
    import {mapActions} from 'vuex';
    export default {
        components : {
            action, tab, formNormal, formAdvance
        },

        props: ['langData'],

        data() {
            return {

            }
        },

        methods: {
            handleClick() {
                this.$store.dispatch('post/saveData')
            },

        },

        created() {
            this.$store.state.post.lang = this.langData;
        },

        mounted() {

        }
    }
</script>