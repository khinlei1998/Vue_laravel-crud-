export default class Gates {

    constructor(user){
        this.user = user;
    }
    isAdmin(){
        return this.user.type == "admin";
    }

    isUser(){
        return this.user.type == "user";
    }
    // isAdminOrUser(){
    //     if(this.user.type === "admin" || this.user.type === "user" ){
    //         return true;

    //     }
    // }

}