<template>

</template>

<script>
import AppStorage from "../../helpers/AppStorage";

export default {
    name: "Logout",
    created() {
        axios.post(`/auth/logout`, {}, {
            headers: {Authorization: `Bearer ${AppStorage.getDataInLocalStorageByKey('token')}`}
        })
            .then(res => {
                AppStorage.clear()
                Toast.fire({
                    icon: 'success',
                    title: 'Logout successfully'
                })
                this.$router.push({ name: 'login'})
            })
            .catch(err => {
                Toast.fire({
                    icon: 'warning',
                    title: 'Logout Fail!'
                })
            })

    }
}
</script>

<style scoped>

</style>
