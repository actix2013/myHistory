<template>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="text-danger m-0"
                @mouseover="hover = true"
                @mouseleave="hover = false"
            >
                <strong>
                    {{ message }}
                </strong>
            </h2>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        message: {
            default:'',
        },
    },
    data: () => {
        return {
            hover: false,
        }
    },
   mounted: function () {

    },
    methods: {
        send() {
            let history = null;
            history= {"userName": 'anonymous', "description": "Mouse go hover "+ this.message, "source": "cv-vuejs"};
            axios.post('/api/history',history , {timeout: 5000})
                .then((message) => {
                    console.log(message);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    watch: {
        hover(){
            console.log('hover called:', this.hover);
            this.send();
        }
    }

};

</script>
