import {postConfig} from '../../api/config';
import axios from 'axios'
const post = {
    namespaced : true,
    state: {
        data : {
            title: "",
            desc: "",
            content: ""
        },
        lang : {

        }
    },

    actions: {
        saveData () {
            console.log(this.state);
            axios.post(postConfig.store, this.state.post)
                .then((response) => {

                })
        }
    },

    mutations : {
        SAVE_DATA (state, res) {

        }
    }
}

export default post