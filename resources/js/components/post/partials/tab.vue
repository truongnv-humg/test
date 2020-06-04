<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">{{ lang.add.general }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">{{ lang.add.advance }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">{{ lang.add.seo }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                lang: this.$store.state.post.lang
            }
        },

        created() {

        }
    }
</script>