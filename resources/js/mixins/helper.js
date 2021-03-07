import AppStorage from "../helpers/AppStorage";

export default {
    methods:{
        checkLogin(){
            if (!User.loggedInAlready()) {
                this.$router.push({name: 'login'})
            }
            else{
                const token = AppStorage.getDataInLocalStorageByKey('token')
                return token
            }
        }
    },
    data(){
        return {
            errors:[]
        }
    }
}
