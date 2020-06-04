<template>
    <div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="">Chọn server</label>
                    <select name="" id="" class="form-control col-6">
                        <option value="">Chọn server</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="file" id="browse" class="form-control-file" v-on:change="selectFile" multiple>
                </div>
                <div id="preview">
                    <img v-for="(image, index) in listImages" :key="index" :src="image" alt="" height="64px" class="p-2">
                </div>
                <input type="button" class="btn btn-success" value="Upload">

            </div>
        </div>
    </div>
</template>

<script>
    import {mediaConfig} from '../../../api/config';
    export default {
        data() {
            return {
                listImages: []
            }
        },



        methods : {
            selectFile(event) {
                const formData = new FormData;
                const files = event.target.files;
                for (let i in files) {
                    formData.append('image_' + i, files[i]);
                }

                axios({
                    method: 'post',
                    url: mediaConfig.upload,
                    data: formData,
                }).then((response) => {

                })
            },


        }
    }
</script>