import AppStorage from "./AppStorage";
import Token from "./Token";
class User {

    responseAfterLogin(res){
        const accessToken = res.data.access_token;
        const user = res.data.user
        if(Token.isValid(accessToken)){
            AppStorage.store(accessToken, user)
        }
    }

    hasToken(){
        const token = AppStorage.getDataInLocalStorageByKey('token')
        if(token)
        {
            return Token.isValid(token)
        }
        else
        {
            return false
        }
    }

    loggedInAlready(){
        return this.hasToken()
    }

    name(){
        if(this.loggedInAlready()){
            return AppStorage.getDataInLocalStorageByKey('user')
        }
        else
            return 'null'
    }
    id(){
        if(this.loggedInAlready()){
            const sub = (Token.payload(AppStorage.getDataInLocalStorageByKey('token'))).sub
            return sub
        }
        else
            return false
    }
}

export default User = new User()
