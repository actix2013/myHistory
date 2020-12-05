<template>
    <div>
        <h2 class="text-danger">
            <strong>
                {{ title }}
            </strong>
        </h2>
    </div>
</template>

<script>
export default {
    data: () => {
        return {
            title: 'EXPERIENCES'
        }
    },
   mounted: function () {
        const dataTitle = this.$parent;
        console.log('datatitle: ', this.$refs.my-title);
    },
};

</script>

<style scoped>

</style>
