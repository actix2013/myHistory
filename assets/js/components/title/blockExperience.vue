<template>
    <div>

        <h2 class="text-danger"
            @mouseover="hover = true"
            @mouseleave="hover = false"
        >
            <strong>
                {{ title }}
            </strong>
        </h2>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data: () => {
        return {
            hover: false,
            title: 'EXPERIENCES'
        }
    },
   mounted: function () {

    },
    methods: {
        send() {

            const data = {};
            data['history'] = {"userName": "postman", "description": "created by postman", "source": "postman"};
            data['top'] = {"userName": "top", "description": "top", "source": "postman"};
            console.log(data);
            axios.post('/api/history', data, {timeout: 5000})
                .then((message) => {
                    console.log(message);
                })
                .catch((error) => {
                    console.log(error);
                })
            ;
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

<style scoped>

</style>
