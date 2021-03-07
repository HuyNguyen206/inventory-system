class AppStorage {
    storeToken(token){
        let item = this.createKeyWithTTL(token)
        localStorage.setItem('token', JSON.stringify(item))
    }
    storeUser(user){
        let item = this.createKeyWithTTL(user)
        localStorage.setItem('user', JSON.stringify(item))
    }
    createKeyWithTTL(value){
        const now = new Date()
        let ttl = 1000 * 60 * 60 * 3;
        //In milisecond
        // `item` is an object which contains the original value
        // as well as the time when it's supposed to expire
        const item = {
            value,
            expiry: now.getTime() + ttl,
        }
        return item
    }
    store(token, user)
    {
        this.storeToken(token)
        this.storeUser(user)
    }
   getDataInLocalStorageByKey(key){
        // if(key == 'user'){
           let data = JSON.parse(localStorage.getItem(key));
           console.log(data)
           if(data){
               console.log('has data')
               let now = new Date()
               if(now.getTime() > data.expiry){
                   localStorage.removeItem('token')
                   localStorage.removeItem('user')
                   return null
               }
               else
               {
                   return data.value
               }
           }
           else{
               return null
           }

        // }
        // else
        //     return localStorage.getItem(key)
   }
   clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
   }

}

export default AppStorage = new AppStorage()
