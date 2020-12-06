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

            let history = null;
            history= {"userName": "experiences", "description": "go hover experience", "source": "vueJS"};
            axios.post('/api/history',history , {timeout: 5000})
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
