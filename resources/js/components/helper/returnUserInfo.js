const returnUserInfo = (parse = false) => {
    if(localStorage.getItem('user-info')){
        if(parse){
            return JSON.parse(localStorage.getItem('user-info'));
        }
        return localStorage.getItem('user-info');
    }
    return null;
}

export default returnUserInfo;