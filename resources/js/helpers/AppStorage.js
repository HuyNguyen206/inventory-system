class AppStorage {
    storeToken(token){
        localStorage.setItem('token', token)
    }
    storeUser(user){
        localStorage.setItem('user', JSON.stringify(user))
    }
    store(token, user)
    {
        this.storeToken(token)
        this.storeUser(user)
    }
   getDataInLocalStorageByKey(key){
        if(key == 'user'){
           return JSON.parse(localStorage.getItem(key))
        }
        else
            return localStorage.getItem(key)
   }
   clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
   }

}

export default AppStorage = new AppStorage()
