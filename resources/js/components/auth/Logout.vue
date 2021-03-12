<template>

</template>

<script>
import AppStorage from "../../helpers/AppStorage";
import helper from "../../mixins/helper";

export default {
    name: "Logout",
    mixins: [helper],
    created() {
        let token = this.checkLogin();
        if(!token){
            return
        }
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
}
</script>

<style scoped>

</style>
