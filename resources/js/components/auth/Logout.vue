<template>

</template>

<script>
import AppStorage from "../../helpers/AppStorage";

export default {
    name: "Logout",
    created() {
        let token = AppStorage.getDataInLocalStorageByKey('token');
        if(token){
            axios.post(`/auth/logout`, {}, {
                headers: {Authorization: `Bearer ${token}`}
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
        else{
            this.$router.push({ name: 'login'})
        }


    }
}
</script>

<style scoped>

</style>
